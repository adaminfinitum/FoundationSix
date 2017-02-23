<?php
/**
 * Register widget areas
 *
 * @package FoundationSix
 * @since FoundationSix 1.0.0
 */

if ( ! function_exists( 'foundationsix_sidebar_widgets' ) ) :
function foundationsix_sidebar_widgets() {
	register_sidebar(array(
	  'id' => 'sidebar-widgets',
	  'name' => __( 'Sidebar widgets', 'foundationsix' ),
	  'description' => __( 'Drag widgets to this sidebar container.', 'foundationsix' ),
	  'before_widget' => '<article id="%1$s" class="widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h5>',
	  'after_title' => '</h5>',
	));

	register_sidebar(array(
	  'id' => 'footer-widgets',
	  'name' => __( 'Footer widgets', 'foundationsix' ),
	  'description' => __( 'Drag widgets to this footer container', 'foundationsix' ),
	  'before_widget' => '<article id="%1$s" class="large-4 columns widget %2$s">',
	  'after_widget' => '</article>',
	  'before_title' => '<h6>',
	  'after_title' => '</h6>',
	));
}

add_action( 'widgets_init', 'foundationsix_sidebar_widgets' );
endif;
