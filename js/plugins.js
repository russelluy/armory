$(document).ready(function(){

	// Global Variables
	var toggle_primary_button    = $('.nav-toggle-button'),  
		toggle_primary_icon    	 = $('.nav-toggle-button i'),  
		toggle_secondary_button  = $('nav li span'),  
		toggle_secondary_icon    = $('nav li span i'),  
		primary_menu        	 = $('nav'),   
		secondary_menu   		 = $('nav ul ul'),
		window_width			 = $(window).width();  
 
 
	//Multi-line Tab
	toggle_secondary_button.each(function(){
		$(this).click(function(){
			$(this).parent("li").children("ul").toggle();
			$(this).children().toggleClass("fa-caret-up").toggleClass("fa-caret-down");;
		});
	});
		
	// Basic functionality for nav-toggle-button
	$(toggle_primary_button).click(function(){
		primary_menu.toggle();		
		toggle_primary_icon.toggleClass("fa-times").toggleClass("fa-navicon");
	});
	
	// Add class to tab having drop down
	$( "nav li:has(ul)").find('span i').addClass("fa-caret-down");		
	
	// Reset all configs when width > 760
	$(window).resize(function(){  
		
		if(window_width > 760 && primary_menu.is(':visible') || primary_menu.is(':hidden') || secondary_menu.is(':visible') || secondary_menu.is(':hidden')) { 
			primary_menu.removeAttr('style');  
			toggle_primary_icon.removeClass("fa-times").addClass("fa-navicon");
			
			secondary_menu.removeAttr('style'); 
			toggle_secondary_icon.removeClass("fa-caret-up").addClass("fa-caret-down");			
		}
	});
	
	/*	Full Width Responsive Slider
	*	For the Full Documentation,
	*	http://getwebplate.com/plugins/flickerplate
	*/
	
	$('.flicker-example').flicker();
	
	
	/* 
	*	Alternative Responsive Slider
	*	$('.rslides').responsiveSlides();
	*/
	
	
});

	
