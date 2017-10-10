
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
			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
				</div><!-- #post-0 -->

				<script type="text/javascript">
					// focus on search field after it has loaded
					document.getElementById('s') && document.getElementById('s').focus();
				</script>

			</div>
		</div>	
</div><!--end main-->
<?php get_footer(); ?>
