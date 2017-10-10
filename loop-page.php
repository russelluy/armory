<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h1 class="page-title"><?php the_title(); ?></h1>
					<?php } else { ?>
						<h1 class="page-title"><?php the_title(); ?></h1>
					<?php } ?>
					
					<div class="content">
					<?php the_content();
					/*** ONLINE FORMS ***/
					if(is_page( '27111' ) || is_page('school-contact-us')){?>
						<p><iframe id="myframe" src="<?php bloginfo('template_url'); ?>/forms/contactForm.php" width="100%" scrolling="no" frameborder="0">Your browser does not support inline frames or is currently configured not to display inline frames. Content can be viewed at actual source page: <?php bloginfo('template_url'); ?>/forms/contactForm.php</iframe>
						<script type="text/javascript">
						//<![CDATA[ 
						document.getElementById('myframe').onload = function(){
						calcHeight();
						};
						//]]>
						</script>
						</p>
					<?php }elseif(is_page( '81111' ) || is_page('school-admissions')){?>	
						<p><iframe id="myframe" src="<?php bloginfo('template_url'); ?>/forms/employmentForm.php" width="100%" scrolling="no" frameborder="0">Your browser does not support inline frames or is currently configured not to display inline frames. Content can be viewed at actual source page: <?php bloginfo('template_url'); ?>/forms/employmentForm.php</iframe>
						<script type="text/javascript">
						//<![CDATA[ 
						document.getElementById('myframe').onload = function(){
						calcHeight();
						};
						//]]>
						</script>
						</p>
					<?php }elseif(is_page( '12111' ) || is_page('school-enroll-online')){?>	
						<p><iframe id="myframe" src="<?php bloginfo('template_url'); ?>/forms/employmentForm.php" width="100%" scrolling="no" frameborder="0">Your browser does not support inline frames or is currently configured not to display inline frames. Content can be viewed at actual source page: <?php bloginfo('template_url'); ?>/forms/employmentForm.php</iframe>
						<script type="text/javascript">
						//<![CDATA[ 
						document.getElementById('myframe').onload = function(){
						calcHeight();
						};
						//]]>
						</script>
						</p>
					<?php }
					wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) );
					edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>
