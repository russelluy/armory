<div class ="wrapper">
<?php
@session_start();
get_includes('head');
get_includes('header');

?>


<?php
if ( is_front_page() ){


}
?>




<section class="grid container clearfix">



<?php   
if(is_page('events') ){
?>

	<div class="page-content align-justify slogan">
	<span class="span1">The most exciting, multi-purpose</span><br>
	<div class="spanhead">event space in San Francisco!</div>
	<?php get_includes('banner'); ?>
	</div>
<?php   

}?>	


<?php   
if(is_page('tours') ){
?>

	<div class="page-content align-justify slogan">
	<span class="span1">Tour San Francisco's most exciting</span><br>
	<div class="spanhead">historic landmark!</div>
	<?php get_includes('tours'); ?>
			</div>
<?php   

}?>	

<?php   
if(is_page('event') ){
?>
<div class="page-content align-justify slogan">
	<span class="span1">The most exciting, multi-purpose</span><br>
	<div class="spanhead">event space in San Francisco!</div>
	<?php get_includes('banner'); ?>
			</div>
<?php get_includes('banner'); ?>
<?php   
}?>	



	<div class="page-content align-justify" style="background-color:rgba(0, 0, 0, 0.6);">

	

			<?php get_template_part('loop','page'); ?>
			
			
<?php
if (is_page('floorplans-2')){
get_includes('mid');
}
?>

<?php
if (is_page('events')){
get_includes('mid');
}
?>

<?php
if (is_page('history')){
}
?>

<?php
if (is_page('bay-area-derby-girls-2014')){
get_includes('mid');
}
?>



<?php
if (is_page('hackcancer-fundraiser-2014')){
get_includes('mid');
}
?>


<?php
if (is_page('past-event')){
get_includes('mid');
}
?>


<?php
if (is_page('halloween-haunted-house-2014')){
get_includes('mid');
}
?>






<?php   
if(is_page('tours') ){
}
?>

<?php   
if(is_page('upcoming-events') ){
get_includes('mid');
}
?>

<?php   
if(is_page('past-event-2') ){
get_includes('mid');
}
?>

<?php   
if(is_page('the-armory-drill-court') ){
get_includes('mid');
}
?>

<?php   
if(is_page('the-basement') ){
get_includes('mid');
}
?>

<?php   
if(is_page('the-upper-floor') ){
get_includes('mid');
}
?>
			
		</div> 
		
		
		  
	</section>


		  	
	

<?php get_includes('footer'); ?>

</div>
