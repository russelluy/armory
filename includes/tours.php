<!--
	READ ME:
	
	For Full Width Responsive Slider
	- enable all required files as seen on footer.php & head.php.
	
	Head.php
	: flickerplate.css
	
	Footer.php
	: jquery-finger-v0.1.0.min.js
	: flickerplate.min.js
	
	- enable the plugin on plugin.js
	: $('.flicker-example').flicker();
	
	==========================================================
	
	For Alternative Responsive SLider
	- enable all required files as seen on footer.php & head.php.
	
	Head.php
	: rslides.css
	
	Footer.php
	: responsiveslides.min.js
	
	- enable the plugin on plugin.js
	: $('.rslides').responsiveSlides();
-->

<div class="container container-style">
<div class="flicker-example" data-block-text="false">

	<ul>

		
		<li data-background="<?php bloginfo('template_url'); ?>/images/slides/hero_lounge.jpg">
			<div class="flick-title"></div>
			<div class="flick-sub-text"></div>
		</li>
		
		<li data-background="<?php bloginfo('template_url'); ?>/images/slides/1.jpg">
			<div class="flick-title"></div>
			<div class="flick-sub-text"></div>
		</li> 
		
		<li data-background="<?php bloginfo('template_url'); ?>/images/slides/2.jpg">
			<div class="flick-title"></div>
			<div class="flick-sub-text"></div>
		</li>

		<li data-background="<?php bloginfo('template_url'); ?>/images/slides/3.jpg">
			<div class="flick-title"></div>
			<div class="flick-sub-text"></div>
		</li>
		<li data-background="<?php bloginfo('template_url'); ?>/images/slides/4.jpg">
			<div class="flick-title"></div>
			<div class="flick-sub-text"></div>
		</li>
		<li data-background="<?php bloginfo('template_url'); ?>/images/slides/5.jpg">
			<div class="flick-title"></div>
			<div class="flick-sub-text"></div>
		</li>
		
	</ul>
	
</div>
</div>
<!--
Alternative Responsive Slide

<div class="container clearfix">
	<ul class="rslides">
		<li><img src="images/slides/field.jpg" alt="Slides"/></li>
		<li><img src="images/slides/forest.jpg" alt="Slides"/></li>
		<li><img src="images/slides/frozen-water.jpg" alt="Slides"/></li>
	</ul>
</div>

-->