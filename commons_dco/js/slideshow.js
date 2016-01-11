

// homepage slideshow config.
// calls cycle.js in Drupal install
// added jw on 10/2/13

 

$(document).ready(function() {

// Check to see if the slideshow element is present (loaded)
// if the slideshow is loaded, then execute the follow blocks of code.
// this will prevent .js issues in the subpages 
// namely null objects  - jw



  $('#block-views-Slideshow_Homepage-block_1 .view-content').before('<div class="slidenav">').cycle({ 
    fx:     'fade',  
    speed:  'slow', 
	prev: '.b4',
	next: '.af',
    timeout: 12000, 
	pager: '.slidenav'
	
  	
 }); // end slideshow init
 $('.dcosummary').css('visibility','visible');


});


  

	
