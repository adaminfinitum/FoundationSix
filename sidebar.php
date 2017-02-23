<?php
/**
 * The sidebar containing the main widget area
 *
 * @package FoundationSix
 * @since FoundationSix 1.0.0
 */

?>
<aside class="sidebar">
	<?php do_action( 'foundationsix_before_sidebar' ); ?>
	<?php dynamic_sidebar( 'sidebar-widgets' ); ?>
	<?php do_action( 'foundationsix_after_sidebar' ); ?>
</aside>
