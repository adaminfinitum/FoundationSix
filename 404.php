<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package FoundationSix
 * @since FoundationSix 1.0.0
 */

get_header(); ?>

<div class="row">
	<div class="small-12 large-8 columns" role="main">

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php _e( 'File Not Found', 'foundationsix' ); ?></h1>
			</header>
			<div class="entry-content">
				<div class="error">
					<p class="bottom"><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'foundationsix' ); ?></p>
				</div>
				<p>Let's see if any of these help:</p>

                        <?php
                        $s = preg_replace("/(.*)-(html|htm|php|asp|aspx)$/","$1",$wp_query->query_vars['name']);
                        $posts = query_posts('post_type=any&name='.$s);
                        $s = str_replace("-"," ",$s);
                        if (count($posts) == 0) {
                            $posts = query_posts('post_type=any&s='.$s);
                        }
                        if (count($posts) > 0) {
                            echo "<ol><li>";
                            echo "<p>Were you looking for one of the these posts or pages?</p>";
                            echo "<ul>";
                            foreach ($posts as $post) {
                                echo '<li><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
                            }
                            echo "</ul>";
                            echo "<h6>If not, please try:</h6></li>";
                        } else {
                            echo "<p>No Worries! Try these:</p>";
                            echo "<ul>";
                        }
                    ?>
                        <li>
                            <label for="s"><b>Searching for it:</b> </label>
                            <form style="display:inline;" action="<?php bloginfo('siteurl');?>">
                                <div class="row collapse">
                                    <div class="large-8 small-9 columns">
                                        <input type="text" value="<?php echo esc_attr($s); ?>" id="s" name="s"/>
                                    </div>
                                    <div class="large-4 small-3 columns">
                                        <input type="submit" value="Search" class="button postfix" />
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li>
                            <b>If you typed in a URL double-check the spelling, punctuation and capitalization.</b>
                        </li>
                        <li>
                            <b>Look for it in the <a href="<?php bloginfo('siteurl');?>/sitemap/">sitemap</a>.</b>
                        </li>
                        <li>
                            <b>Start over on the <a href="<?php bloginfo('siteurl');?>">homepage</a></b> (and please <a href="<?php bloginfo('siteurl');?>/contact/">contact me</a> and let me know what's broken).
                        </li>
                    </ol>
			</div>
			<footer>
               <div id="wb404"></div>
               <script src="https://archive.org/web/wb404.js"></script>
            </footer>
		</article>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer();



