<div class ="wrapper">
<?php
@session_start();
get_includes('head');
get_includes('header');

?>


<?php
if ( is_front_page() ){
get_includes('banner');

}
?>

<?php   
if(is_page('about-us') ){
get_includes('banner-3');
}
?>









<section class="grid container clearfix">

		<div class="page-content align-justify" style="background-color:rgba(0, 0, 0, 0.6);">

			<?php get_template_part('loop','page'); ?>
			
			<!-- <h1 class="align-center title">THE ARMORY EVENT CENTER</h1>

			<p>The Armory facility consists of several unique spaces within the building located at the crossroads of the ever-evolving Mission and South of Market districts. The location is conveniently served by Muni routes, major bus lines and is easily accessible by BART that serves the East Bay and the airport. Parking can be arranged using local lots or valet.</p>
			<br>
			<p>Considerable time and thought have been invested into the Armory Event Center resulting in highly adaptable spaces to maximize their potential and widen the range of event options.</p>
			<br>
			<p>The diversity of the Armory Event Center makes it a perfect venue for a variety of events: intimate private parties, dinner, dances, large Corporate functions, concerts, sporting events, fashion shows, film screenings and the perfect backdrop for photography shoots.</p>
			<br>
			<p>The Armory Event Center boasts a full service professional events team, an unlimited range of set-up options for our clients, a full service bar and many years of event production experience by our staff.</p>
			<br>
			<div class="spaces-holder container align-center">
				<h1 class="align-center title">THE SPACES</h1>

				<div class="tile inline-block align-top">
					<a class="space-a" href=""><img src="<?php bloginfo('template_url'); ?>/images/drillcourt_a_sm.png" alt="Thumb" />
					</a>
				</div>
				
				<div class="tile inline-block align-top">
					<a class="space-a" href=""><img src="<?php bloginfo('template_url'); ?>/images/spaces_basement.png" alt="Thumb" />
					</a>
				</div>
				
				<div class="tile inline-block align-top">
					<a class="space-a" href=""><img src="<?php bloginfo('template_url'); ?>/images/tuf_b_sm.png" alt="Thumb" />
					</a>
				</div>

				<div class="container">
					<div class="col-sm-6"><a href="#" class="btn-past float-right">PAST EVENTS</a></div>
					<div class="col-sm-6"><a href="#" class="btn-floor float-left">FLOOR PLANS</a></div>
				</div>
			</div>-->

			<?php
if ( is_front_page() ){
get_includes('mid');
}
?>

			
		</div> 
		
		
		  
	</section>


		  	
	

<?php get_includes('footer'); ?>

</div>