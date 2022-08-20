<?php
/**
 * Theme Options and override-options support
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0.29
 */


// -----------------------------------------------------------------
// -- Override-options
// -----------------------------------------------------------------

if ( !function_exists('travesia_init_override') ) {
    add_action( 'after_setup_theme', 'travesia_init_override' );
    function travesia_init_override() {
        if ( is_admin() ) {
            add_action('admin_enqueue_scripts',	'travesia_add_override_scripts');
            add_action('save_post',				'travesia_save_override');
        }
    }
}

// Load required styles and scripts for admin mode
if ( !function_exists( 'travesia_add_override_scripts' ) ) {
    function travesia_add_override_scripts() {
        // If current screen is 'Edit Page' - load font icons
        $screen = function_exists('get_current_screen') ? get_current_screen() : false;
        if (is_object($screen) && travesia_options_allow_override(!empty($screen->post_type) ? $screen->post_type : $screen->id)) {
            wp_enqueue_style( 'fontello-icons',  travesia_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
            wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );
            wp_enqueue_script( 'jquery-ui-accordion', false, array('jquery', 'jquery-ui-core'), null, true );
            wp_enqueue_script( 'travesia-options', travesia_get_file_url('theme-options/theme.options.js'), array('jquery'), null, true );
            wp_localize_script( 'travesia-options', 'travesia_dependencies', travesia_get_theme_dependencies() );
        }
    }
}


// Check if override options is allow
if (!function_exists('travesia_options_allow_override')) {
    function travesia_options_allow_override($post_type) {
        return apply_filters('travesia_filter_allow_override', in_array($post_type, array('page', 'post')), $post_type);
    }
}

// Add overriden options
if (!function_exists('travesia_options_override_add_options')) {
    add_filter('travesia_filter_override_options', 'travesia_options_override_add_options');
    function travesia_options_override_add_options($list) {
        global $post_type;
        if (travesia_options_allow_override($post_type)) {
            $list[] = array(sprintf('travesia_override_options_%s', $post_type),
                esc_html__('Theme Options', 'travesia'),
                'travesia_show_override',
                $post_type,
                $post_type=='post' ? 'side' : 'advanced',
                'default'
            );
        }
        return $list;
    }
}

// Callback function to show fields in override options
if (!function_exists('travesia_show_override')) {
    function travesia_show_override() {
        global $post, $post_type;
        if (travesia_options_allow_override($post_type)) {
            // Load saved options
            $meta = get_post_meta($post->ID, 'travesia_options', true);
            $tabs_titles = $tabs_content = array();
            global $TRAVESIA_STORAGE;
            // Refresh linked data if this field is controller for the another (linked) field
            // Do this before show fields to refresh data in the $TRAVESIA_STORAGE
            foreach ($TRAVESIA_STORAGE['options'] as $k=>$v) {
                if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
                if (!empty($v['linked'])) {
                    $v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
                    if (!empty($v['val']) && !travesia_is_inherit($v['val']))
                        travesia_refresh_linked_data($v['val'], $v['linked']);
                }
            }
            // Show fields
            foreach ($TRAVESIA_STORAGE['options'] as $k=>$v) {
                if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
                if (empty($v['override']['section']))
                    $v['override']['section'] = esc_html__('General', 'travesia');
                if (!isset($tabs_titles[$v['override']['section']])) {
                    $tabs_titles[$v['override']['section']] = $v['override']['section'];
                    $tabs_content[$v['override']['section']] = '';
                }
                $v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
                $tabs_content[$v['override']['section']] .= travesia_options_show_field($k, $v, $post_type);
            }
            if (count($tabs_titles) > 0) {
                ?>
                <div class="travesia_options travesia_override_options">
                    <input type="hidden" name="override_options_post_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
                    <input type="hidden" name="override_options_post_type" value="<?php echo esc_attr($post_type); ?>" />
                    <div id="travesia_options_tabs" class="travesia_tabs">
                        <ul><?php
                            $cnt = 0;
                            foreach ($tabs_titles as $k=>$v) {
                                $cnt++;
                                ?><li><a href="#travesia_options_<?php echo esc_attr($cnt); ?>"><?php echo esc_html($v); ?></a></li><?php
                            }
                            ?></ul>
                        <?php
                        $cnt = 0;
                        foreach ($tabs_content as $k=>$v) {
                            $cnt++;
                            ?>
                            <div id="travesia_options_<?php echo esc_attr($cnt); ?>" class="travesia_tabs_section travesia_options_section">
                                <?php travesia_show_layout($v); ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        }
    }
}


// Save data from override options
if (!function_exists('travesia_save_override')) {
    //Handler of the add_action('save_post', 'travesia_save_override');
    function travesia_save_override($post_id) {

        // verify nonce
        if ( !wp_verify_nonce( travesia_get_value_gp('override_options_post_nonce'), admin_url() ) )
            return $post_id;

        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        $post_type = wp_kses_data(wp_unslash(isset($_POST['override_options_post_type']) ? $_POST['override_options_post_type'] : $_POST['post_type']));

        // check permissions
        $capability = 'page';
        $post_types = get_post_types( array( 'name' => $post_type), 'objects' );
        if (!empty($post_types) && is_array($post_types)) {
            foreach ($post_types  as $type) {
                $capability = $type->capability_type;
                break;
            }
        }
        if (!current_user_can('edit_'.($capability), $post_id)) {
            return $post_id;
        }

        // Save meta
        $meta = array();
        $options = travesia_storage_get('options');
        foreach ($options as $k=>$v) {
            // Skip not overriden options
            if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
            // Skip inherited options
            if (!empty($_POST['travesia_options_inherit_' . $k])) continue;
            // Get option value from POST
            $meta[$k] = isset($_POST['travesia_options_field_' . $k])
                ? travesia_get_value_gp('travesia_options_field_' . $k)
                : ($v['type']=='checkbox' ? 0 : '');
        }
        update_post_meta($post_id, 'travesia_options', $meta);

        // Save separate meta options to search template pages
        if ($post_type=='page' && !empty($_POST['page_template']) && $_POST['page_template']=='blog.php') {
            update_post_meta($post_id, 'travesia_options_post_type', isset($meta['post_type']) ? $meta['post_type'] : 'post');
            update_post_meta($post_id, 'travesia_options_parent_cat', isset($meta['parent_cat']) ? $meta['parent_cat'] : 0);
        }
    }
}
?>