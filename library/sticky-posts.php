<?php
/**
 * Change the class for sticky posts to .wp-sticky to avoid conflicts with Foundation's Sticky plugin
 *
 * @package FoundationSix
 * @since FoundationSix 2.2.0
 */

if ( ! function_exists( 'foundationsix_sticky_posts' ) ) :
function foundationsix_sticky_posts( $classes ) {
	if ( in_array( 'sticky', $classes, true ) ) {
	    $classes = array_diff($classes, array('sticky'));
	    $classes[] = 'wp-sticky';
	}
	return $classes;
}
add_filter('post_class','foundationsix_sticky_posts');

endif;
