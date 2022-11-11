<?php
/*adding sections for header logo options*/
$wp_customize->add_section( 'supermag-header-logo', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Logo Options', 'supermag' ),
    'panel'          => 'supermag-header-panel',
) );

/*header logo*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-logo]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-header-logo'],
    'sanitize_callback' => 'supermag_sanitize_image',
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'supermag_theme_options[supermag-header-logo]',
        array(
            'label'		=> __( 'Logo', 'supermag' ),
            'section'   => 'supermag-header-logo',
            'settings'  => 'supermag_theme_options[supermag-header-logo]',
            'type'	  	=> 'image',
            'priority'  => 10
        )
    )
);

/*header logo alternative*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-alt]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-header-alt'],
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-header-alt]', array(
    'label'		=> __( 'Logo Alt Text', 'supermag' ),
    'section'   => 'supermag-header-logo',
    'settings'  => 'supermag_theme_options[supermag-header-alt]',
    'type'	  	=> 'text',
    'priority'  => 20
) );

/*header logo/text display options*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-id-display-opt]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-header-id-display-opt'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_header_id_display_opt();
$wp_customize->add_control( 'supermag_theme_options[supermag-header-id-display-opt]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Logo/Site Title-Tagline Display Options', 'supermag' ),
    'section'   => 'supermag-header-logo',
    'settings'  => 'supermag_theme_options[supermag-header-id-display-opt]',
    'type'	  	=> 'radio',
    'priority'  => 30
) );