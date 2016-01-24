<?php

include_once( "utils.php" ) ;

// In any drupal page the arg function is like grabbing the path and information
// about the page. The 1 argument for this page is the uid. For example, 8 for
// pwest.
$uid = arg( 1 ) ;

// Build the user information array that will help Drupal load the right user
// from the database. Call user_load to load it.
$user_info = array( 'uid' => $uid ) ;
$user = user_load( $user_info ) ;
if( $user === false )
{
    print( "We were unable to grab the user's profile information<br/>" ) ;
}
else
{

// get the username from the user object. This will be, for example, pwest. And
// we can use this in the SPARQL query to get the user's information
$username = $user->name ;

// sparql query to pull back the user's information. This query is running slow
// and needs to be sped up. But with all the information we're pulling back I
// don't see anything to speed up.
$query = "network_id:$username" ;

// Initialize the curl object.
dco_init() ;

// Run the query and pull back the json object
$j = runESQuery( $query ) ;
// no matter if the bindings are returned or not we close the curl object now
dco_cleanUp() ;

if( $j === false )
{
    print( "We were unable to query for the user's profile information<br/>" ) ;
}
else
{

print( "*************<br/>" ) ;
$obj = $j->hits->hits[0]->_source ;
// These divs were pulled from the original view
print( "<div id=\"content-content\" class=\"content-content\">" ) ;
print( "<div id=\"view-id-profile_about_page-page_1\" class=\"view view-profile-about-page view-id-profile_about_page view-display-id-page_1 view-dom-id-1 \">" ) ;
print( "<div class=\"inner content\">" ) ;
print( "<div class=\"view-content\">" ) ;
print( "<div class=\"views-row views-row-1 views-row-odd views-row-first views-row-last\">" ) ;
print( "" ) ;

// Display the name with a link to the dcoid
$dcoid = $obj->dcoId ;
$name = $obj->name ;
print( "<div class=\"views-field-value-1\">" ) ;
print( "<label class=\"views-label-value-1\">" ) ;
print( "Name:" ) ;
print( "</label>" ) ;
print( "<span class=\"field-content\"><a href=\"$dcoid\">$name</a></span>" ) ;
print( "</div>" ) ;
print( "" ) ;

// Display the user's organizations, seperated by a comma
print( "<div class=\"views-field-value-5\">" ) ;
print( "<label class=\"views-label-value-5\">" ) ;
print( "Organization:" ) ;
print( "</label>" ) ;
$orgs = $obj->organization ;
for( $i = 0; $i < count( $orgs ); $i++ )
{
    $org = $orgs[$i] ;
    if( $i != 0 ) print( ", " ) ;
    print( "<a href=\"" . $org->uri . "\">" . $org->name . "</a>" ) ;
}
print( "</div>" ) ;
print( "" ) ;

// Display the user's emails, separated by a comma
$emaillabels = explode( "|", $bindings[0]->email_label->value ) ;
print( "<div class=\"views-field-value-18\">" ) ;
print( "<label class=\"views-label-value-18\">" ) ;
print( "Public E-mail:" ) ;
print( "</label>" ) ;
print( "<span class=\"field-content\">" ) ;
print( "<a href=\"mailto:" . $obj->email . "\">" . $obj->email . "</a>" ) ;
print( "</span>" ) ;
print( "</div>" ) ;
print( "" ) ;

// Display the DCO Communities this user is a member of, separated by a comma
print( "<div class=\"views-field-tid\">" ) ;
print( "<label class=\"views-label-tid\">" ) ;
print( "DCO Communities:" ) ;
print( "</label>" ) ;
$comms = $obj->dcoCommunities ;
for( $i = 0; $i < count( $comms ); $i++ )
{
    $comm = $comms[$i]->community ;
    if( $i != 0 ) print( ", " ) ;
    print( "<a href=\"" . $comm->uri . "\">" . $comm->name . "</a>" ) ;
}
print( "</div>" ) ;
print( "" ) ;

// Display the DCO Portal Groups this user is a member of, separated by a comma
print( "<div class=\"views-field-tid\">" ) ;
print( "<label class=\"views-label-tid\">" ) ;
print( "Teams:" ) ;
print( "</label>" ) ;
$teams = $obj->teams ;
for( $i = 0; $i < count( $teams ); $i++ )
{
    $team = $teams[$i]->team ;
    if( $i != 0 ) print( ", " ) ;
    print( "<a href=\"" . $team->uri . "\">" . $team->name . "</a>" ) ;
}
print( "</div>" ) ;
print( "" ) ;

// Display the user's areas of expertise, separated by a comma
print( "<div class=\"views-field-value-6\">" ) ;
print( "<label class=\"views-label-value-6\">" ) ;
print( "Areas of expertise:" ) ;
print( "</label>" ) ;
$areas = $obj->researchArea ;
for( $i = 0; $i < count( $areas ); $i++ )
{
    $area = $areas[$i] ;
    if( $i != 0 ) print( ", " ) ;
    print( "<a href=\"" . $area->uri . "\">" . $area->name . "</a>" ) ;
}
print( "</div>" ) ;
print( "" ) ;

// Display the user's home country, should be one
$country = $obj->homeCountry->name ;
print( "<div class=\"views-field-value\">" ) ;
print( "<label class=\"views-label-value\">" ) ;
print( "Home Country:" ) ;
print( "</label>" ) ;
print( "<span class=\"field-content\">$country</span>" ) ;
print( "</div>" ) ;
print( "" ) ;

print( "<br/><a href=\"$dcoid\">Additional Information...</a>" ) ;

print( "</div>" ) ;
print( "</div>" ) ;
print( "</div>" ) ;
print( "</div>" ) ;
print( "</div>" ) ;

}
}
?>
