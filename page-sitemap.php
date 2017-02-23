<?php
/**
 *
 Template Name: HTML Sitemap Page
 *
 * The sitemap template file
 *
 * This template is only used to render an HTML sitemap on a page.
 * By default it will display links to all pages and all posts
 * Make sure you exclude your "thank you" pages (for conversion tracking)
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package FoundationSix
 * @since FoundationSix 1.0.0
 */

get_header(); ?>

<div id="page" role="main">
  <article class="main-content">
  <?php if ( have_posts() ) : ?>

    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
    <?php endwhile; ?>

    <?php else : ?>
      <?php get_template_part( 'template-parts/content', 'none' ); ?>

    <?php endif; // End have_posts() check. ?>

    <?php /* Sitemap partial might not work in the Loop...not sure */ ?>
    <?php get_template_part('/template-parts/sitemap'); ?>

  </article>
  <?php get_sidebar(); ?>

</div>

<?php get_footer();
