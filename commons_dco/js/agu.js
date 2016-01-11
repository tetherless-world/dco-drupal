
$(document).ready(function() {
// Footer hack. the dco.net footer nav bar is a dupe of the main nav bar - and unfortunately uses the same ID.


// Loading image - animates while info loads in
var ajax_load = "<img class='loading' src='http://deepcarbon.net/sites/dco.rpi.edu/files/images/loading2.gif' width='210' height='150' alt='loading...' />";
// Need to hide the second nav bar due to conflicts in js
$( "ul.menu.sf-menu:eq( 1 )" ).hide();
$("h1.title").hide();

// nav button coloring
$("#agunav a").css("background-color", "#8f928d");
$("#overview").css("background-color", "#b7312c");

// Don't cache me sleeping
$.ajaxSetup ({
	cache: false
});

// get the current hash from the URL
var hash = window.location.hash.substring(1);
// if there's a hash, call the html via ajax. or default to the "overview" html

	// Set the nav bar BG color
	$("#agunav a").css("background-color", "#8f928d");
	$("#"+hash).css("background-color", "#b7312c");
	// sloppy: map the hash to URL. if the hash doesn't match a day, send them along to the "overview page"
	
	if(hash =="monday") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-monday";
	} else if (hash =="tuesday") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-tuesday"; 
	} else if (hash =="wednesday") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-wednesday"; 
	} else if (hash =="thursday") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-thursday"; 
	} else if (hash =="friday") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-friday"; 
	} else {
		$("#overview").css("background-color", "#b7312c");
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-overview"; 
	}
	
	
	//Load the URL in the #result div
	$("#result").html(ajax_load).load(goUrl + ' #content-content' , function( response, status, xhr ) {
	
	// throw an error message is a problem arises
	if ( status == "error" ) {
		var msg = "<br />Sorry but there appears to be an error: ";
		$( "#result" ).html( msg + xhr.status + " " + xhr.statusText );
	}
});

// sloppy function to set the URL > button clicks (broke the page load function out in order to track mangled queries)
// gets the day from a href on the nav or the hash in the URL	
function urlFinder(clicker) {

	if(clicker =="monday") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-monday";
	} else if (clicker =="tuesday") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-tuesday"; 
	} else if (clicker =="wednesday") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-wednesday"; 
	} else if (clicker =="thursday") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-thursday"; 
	} else if (clicker =="friday") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-friday"; 
	} else if (clicker =="overview") {
		var goUrl = "http://deepcarbon.net/feature/2013-agu-conference-overview"; 
	} else {	
	var goUrl = clicker;
	}
	return goUrl;
}

// Capture clicks to load new ajax panel
$("#agunav a").click(function(){
	$("#agunav a").css("background-color", "#8f928d");
	$(this).css("background-color", "#b7312c");
	 window.location.hash = this.id;
	
	//loadUrl = (this.id + '.html');
	$("#result").html(ajax_load).load(urlFinder(this.id) + ' #content-content' , function( response, status, xhr ) {
	
	// throw error message is a problem arises
	if ( status == "error" ) {
		var msg = "<br />Sorry but there appears to be an error: ";
		$( "#result" ).html( msg + xhr.status + " " + xhr.statusText );
	}
});

});

});
