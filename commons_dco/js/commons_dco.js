

$(document).ready(function() {

Drupal.behaviors.check_js = function (context) {
  
  if ($('html').hasClass('no-js')) {
    $('html').removeClass('no-js');
  }

};

// This affects the height of the 'multiple' select menus in the admin area.
// Drupal's output of the markup didn't allow for a CSS alternative.
// 12/6/2013 -jw
$( "select[multiple]" ).css('height', '125px');


Drupal.behaviors.user_dropdown = function (context) {
  
  if (!$('body').hasClass('user-dropdown-processed')) {
    
    $('body').addClass('user-dropdown-processed');
    $('.view-user-meta .views-field-name a').attr('href','javascript:;');
    $('.views-field-nothing, .views-field-nothing-1').wrapAll('<div class="user-field-options" />');
    $('.user-field-options').width($('.view-user-meta .views-field-name .welcome-text').width());
    
    $('.view-user-meta .views-field-name a').click(function(){
      if ($('body').hasClass('user-dropdown-open')) {
        $('.user-field-options').hide();
        $('body').removeClass('user-dropdown-open');
      } else {
        $('.user-field-options').show();
        $('body').addClass('user-dropdown-open');
      }
    });
    
  }

};


Drupal.behaviors.equal_height = function (context) {
  
  var height = 0;
  
  var elements = $('#sidebar-first, #sidebar-last, #content-group');
  
  elements.each(function(){
    if ($(this).height() > height) {
      height = $(this).height();
    }
  });
  
  elements.css('min-height',height + 'px');

};

///////////////////////////////////////////////
//
// The code to handle the 'help' button dialog
// windows with the howto text.
//
// "Opener" is the button ID, "dialog" is the dialog ID
//
// Copy is handled in the Blocks within the Drupal CMS.
// Added by jw - Sep 16,2013
// 
///////////////////////////////////////////////

// Need to wait until the button element "#opener" is loaded into the page before
// any action can take place. Otherwise crickets and tumbleweeds.

$( "#opener" ).load(function() {
    // jquery is loaded
    // console.log( "Yes - jquery is here. Ready!" );
    
    // Set the options for the jquery UI (v1.6) Dialog box 
    // Refer to the jquery UI web site for details
	  $( "#dialog" ).dialog({
		autoOpen: false, 
		resizable: false,
			height:450,
			width: 750,
			buttons: {
				Close: function() {
					$(this).dialog('close');
				}
			}
		});
	// Here's the Button click action on the "Help" button.	
	// Opens the dialog box and adds a style hack to override 
	// a goofy style issue that was obscuring the scrollbars.
	$( "#opener" ).click(function() {
		$( "#dialog" ).dialog( "open" );
		$(".ui-dialog-content").css("padding", "0px");

	});
  
});

});

	
