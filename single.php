<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationSix
 * @since FoundationSix 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div id="single-post" role="main">

<?php do_action( 'foundationsix_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php foundationsix_entry_meta(); ?>
		</header>
		<?php do_action( 'foundationsix_post_before_entry_content' ); ?>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php edit_post_link( __( 'Edit', 'foundationsix' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		<footer>
			<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationsix' ), 'after' => '</p></nav>' ) ); ?>
			<p><?php the_tags(); ?></p>
		</footer>
		<?php the_post_navigation(); ?>
		<?php do_action( 'foundationsix_post_before_comments' ); ?>
		<?php comments_template(); ?>
		<?php do_action( 'foundationsix_post_after_comments' ); ?>
	</article>
<?php endwhile;?>

<?php do_action( 'foundationsix_after_content' ); ?>
<?php get_sidebar(); ?>
</div>
<?php get_footer();
