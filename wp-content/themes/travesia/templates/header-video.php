<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0.14
 */
$travesia_header_video = travesia_get_header_video();
$travesia_embed_video = '';
if (!empty($travesia_header_video) && !travesia_is_from_uploads($travesia_header_video)) {
	if (travesia_is_youtube_url($travesia_header_video) && preg_match('/[=\/]([^=\/]*)$/', $travesia_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$travesia_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($travesia_header_video) . '[/embed]' ));
			$travesia_embed_video = travesia_make_video_autoplay($travesia_embed_video);
		} else {
			$travesia_header_video = str_replace('/watch?v=', '/embed/', $travesia_header_video);
			$travesia_header_video = travesia_add_to_url($travesia_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$travesia_embed_video = '<iframe src="' . esc_url($travesia_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php travesia_show_layout($travesia_embed_video); ?></div><?php
	}
}
?>