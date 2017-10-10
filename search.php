<?php
@session_start();
get_header();
get_includes('banner');
get_includes('nav');
?>
	<?php if ( is_front_page() ): ?>
		<?php get_includes('flash'); ?>
		<?php get_includes('mid'); ?>
	<?php endif ?>

	<!--main-->
<div id="main">
		<?php get_includes('left'); ?>
		<div id="col-b">
			<div class = "maincontents">
			<?php if ( have_posts() ) : ?>
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<div class="search_results">
					<?php
					/* Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called loop-search.php and that will be used instead.
					 */
					 get_template_part( 'loop', 'search' );
					?>
					</div>
				<?php else : ?>
					<div id="post-0" class="post no-results not-found">
						<h2 class="entry-title"><?php _e( 'Nothing Found', 'twentyten' ); ?></h2>
						<div class="entry-content">
							<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .entry-content -->
					</div><!-- #post-0 -->
				<?php endif; ?>
			</div>
		</div>	
</div><!--end main-->
<?php get_footer(); ?>

