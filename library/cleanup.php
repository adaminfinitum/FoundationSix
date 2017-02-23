<?php
/**
 * Clean up WordPress defaults
 *
 * @package FoundationSix
 * @since FoundationSix 1.0.0
 */

if ( ! function_exists( 'foundationsix_start_cleanup' ) ) :
function foundationsix_start_cleanup() {

	// Launching operation cleanup.
	add_action( 'init', 'foundationsix_cleanup_head' );

	// Remove WP version from RSS.
	add_filter( 'the_generator', 'foundationsix_remove_rss_version' );

	// Remove pesky injected css for recent comments widget.
	add_filter( 'wp_head', 'foundationsix_remove_wp_widget_recent_comments_style', 1 );

	// Clean up comment styles in the head.
	add_action( 'wp_head', 'foundationsix_remove_recent_comments_style', 1 );

	// Remove inline width attribute from figure tag
	add_filter( 'img_caption_shortcode', 'foundationsix_remove_figure_inline_style', 10, 3 );

	// Clean up gallery output in wp
	add_filter('gallery_style', 'foundationsix_gallery_style');
}
add_action( 'after_setup_theme','foundationsix_start_cleanup' );
endif;
/**
 * Clean up head.+
 * ----------------------------------------------------------------------------
 */

if ( ! function_exists( 'foundationsix_cleanup_head' ) ) :
function foundationsix_cleanup_head() {

	// EditURI link. Needed for JetPack & Tumblr post scheduling
	// remove_action( 'wp_head', 'rsd_link' );

	// Category feed links.
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Post and comment feed links.
	remove_action( 'wp_head', 'feed_links', 2 );

	// Windows Live Writer.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Index link.
	remove_action( 'wp_head', 'index_rel_link' );

	// Previous link.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// Start link.
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// Remove the Canonical Link? Bad idea.
	// remove_action( 'wp_head', 'rel_canonical', 10, 0 );

	// Shortlink.
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	// Links for adjacent posts.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// WP version.
	remove_action( 'wp_head', 'wp_generator' );

	// Emoji detection script.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

	// Emoji styles.
	remove_action( 'wp_print_styles', 'print_emoji_styles' );

    // Remove WP version from css
	add_filter( 'style_loader_src', 'foundationsix_remove_wp_ver_css_js', 9999 );

	// Remove WP version from scripts
	add_filter( 'script_loader_src', 'foundationsix_remove_wp_ver_css_js', 9999 );
}
endif;

// Remove WP version from scripts
if( ! function_exists( 'foundationsix_remove_wp_ver_css_js ' ) ) {
	function foundationsix_remove_wp_ver_css_js( $src ) {
	    if ( strpos( $src, 'ver=' ) )
	        $src = remove_query_arg( 'ver', $src );
	    return $src;
	}
}

// Remove WP version from RSS.
if ( ! function_exists( 'foundationsix_remove_rss_version' ) ) :
function foundationsix_remove_rss_version() { return ''; }
endif;

// Remove injected CSS for recent comments widget.
if ( ! function_exists( 'foundationsix_remove_wp_widget_recent_comments_style' ) ) :
function foundationsix_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
	  remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}
endif;

// Remove injected CSS from recent comments widget.
if ( ! function_exists( 'foundationsix_remove_recent_comments_style' ) ) :
function foundationsix_remove_recent_comments_style() {
	global $wp_widget_factory;
	if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
	remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}
endif;

// Remove inline width attribute from figure tag causing images wider than 100% of its conainer
if ( ! function_exists( 'foundationsix_remove_figure_inline_style' ) ) :
function foundationsix_remove_figure_inline_style( $output, $attr, $content ) {
	$atts = shortcode_atts( array(
		'id'	  => '',
		'align'	  => 'alignnone',
		'width'	  => '',
		'caption' => '',
		'class'   => '',
	), $attr, 'caption' );

	$atts['width'] = (int) $atts['width'];
	if ( $atts['width'] < 1 || empty( $atts['caption'] ) ) {
		return $content;
	}

	if ( ! empty( $atts['id'] ) ) {
		$atts['id'] = 'id="' . esc_attr( $atts['id'] ) . '" ';
	}

	$class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );

	if ( current_theme_supports( 'html5', 'caption' ) ) {
		return '<figure ' . $atts['id'] . ' class="' . esc_attr( $class ) . '">'
		. do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $atts['caption'] . '</figcaption></figure>';
	}

}
endif;

// remove injected CSS from gallery
if( ! function_exists( 'foundationsix_gallery_style ' ) ) {
	function foundationsix_gallery_style($css) {
	  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
	}
}
endif;

// Clean up output of stylesheet <link> tags
if( ! function_exists( 'foundationsix_clean_style_tag ' ) ) {
    function foundationsix_clean_style_tag($input) {
      preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
      // Only display media if it is meaningful
      $media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
      return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
    }
}
endif;
add_filter('style_loader_tag', 'foundationsix_clean_style_tag');


// Remove unnecessary self-closing tags
if( ! function_exists( 'foundationsix_remove_self_closing_tags ' ) ) {
    function foundationsix_remove_self_closing_tags($input) {
      return str_replace(' />', '>', $input);
    }
}
endif;
add_filter('get_avatar',          'foundationsix_remove_self_closing_tags'); // <img />
add_filter('comment_id_fields',   'foundationsix_remove_self_closing_tags'); // <input />
add_filter('post_thumbnail_html', 'foundationsix_remove_self_closing_tags'); // <img />


// Add WooCommerce support for wrappers per http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_before_main_content', 'foundationsix_before_content', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_after_main_content', 'foundationsix_after_content', 10);
