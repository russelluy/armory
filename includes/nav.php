<!--
Read Me:
	Copy the code below inside your PHP tag for adding of Dynamic Tabs on Wordpress HAVING DROP DOWNS.
		
	wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'after' => '<span><i class="fa fa-2x">&nbsp;&nbsp;&nbsp;&nbsp;</i></span>' ) ); 
-->

<a class="nav-toggle-button">
	<i class="fa fa-navicon fa-2x">
	&nbsp;&nbsp;&nbsp;&nbsp;
	</i> 
</a>

<nav class="page-nav align-center dropdown">
	
	<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
	
	<!-- <ul>
		<li class="current_page_item"><a href="">HOME</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
		<li><a href="">TOURS</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
		<li><a href="">WORKSHOPS</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
		<li><a href="">STAGE RENTALS</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
		<li><a href="">SETS & STAGES</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
		<li><a href="">PRODUCTION RENTALS & SERVICES</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
		<li><a href="">FLOORPLANS</a></li>
		<li><a href="">MEDIA</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
		<li><a href="">HISTORY</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
		<li><a href="">CONTACT</a></li>&nbsp;&nbsp;|&nbsp;&nbsp;
		<li><a href="">FAQ</a></li>
	</ul> -->


	
</nav>