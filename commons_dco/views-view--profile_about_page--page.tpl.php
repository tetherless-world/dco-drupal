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
$query = "
PREFIX rdf:   <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs:  <http://www.w3.org/2000/01/rdf-schema#>
PREFIX xsd:   <http://www.w3.org/2001/XMLSchema#>
PREFIX dco: <http://info.deepcarbon.net/schema#>
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
PREFIX ocrer: <http://purl.org/net/OCRe/research.owl#>
PREFIX ocresd: <http://purl.org/net/OCRe/study_design.owl#>
PREFIX vivo: <http://vivoweb.org/ontology/core#>
PREFIX obo: <http://purl.obolibrary.org/obo/>
PREFIX vcard: <http://www.w3.org/2006/vcard/ns#>

SELECT ?person ?dco_id ?label
  (GROUP_CONCAT(DISTINCT ?comm ; SEPARATOR=\"|\") AS ?community)
  (GROUP_CONCAT(DISTINCT ?comm_label ; SEPARATOR=\"|\") AS ?community_label)
  (GROUP_CONCAT(DISTINCT ?gp ; SEPARATOR=\"|\") AS ?group)
  (GROUP_CONCAT(DISTINCT ?gp_label ; SEPARATOR=\"|\") AS ?group_label)
  (GROUP_CONCAT(DISTINCT ?org ; SEPARATOR = \"|\") AS ?organization)
  (GROUP_CONCAT(DISTINCT ?org_label ; SEPARATOR = \"|\") AS ?organization_label)
  (GROUP_CONCAT(DISTINCT ?networkId ; SEPARATOR = \"|\") AS ?uid)
  (GROUP_CONCAT(DISTINCT ?ra ; SEPARATOR = \"|\") AS ?expertise)
  (GROUP_CONCAT(DISTINCT ?ra_label ; SEPARATOR = \"|\") AS ?expertise_label)
  (GROUP_CONCAT(DISTINCT ?co_label ; SEPARATOR = \"|\") AS ?country_label)
  (GROUP_CONCAT(DISTINCT ?e_label ; SEPARATOR = \"|\") AS ?email_label)
where
{
  ?person a foaf:Person ; rdfs:label ?p_l .
  ?person <http://vivo.mydomain.edu/ns#networkId> ?networkId .
  FILTER (?networkId = \"$username\"^^xsd:string) .
  OPTIONAL { ?person dco:hasDcoId ?id . }
  OPTIONAL { ?person dco:inOrganization ?org . ?org rdfs:label ?ol . }
  OPTIONAL { ?person dco:associatedDCOCommunity ?comm . ?comm rdfs:label ?c_l . }
  OPTIONAL { ?person dco:associatedDCOPortalGroup ?gp . ?gp rdfs:label ?g_l . }
  OPTIONAL { ?person vivo:hasResearchArea ?ra . ?ra rdfs:label ?r_l . }
  OPTIONAL { ?person dco:homeCountry ?co . ?co rdfs:label ?co_l . }
  OPTIONAL { ?person obo:ARG_2000028 ?contact . ?contact vcard:hasEmail ?eobj . ?eobj vcard:email ?e_l . }
  BIND(str(?p_l) AS ?label) .
  BIND(str(?id) AS ?dco_id) .
  BIND(str(?ol) AS ?org_label) .
  BIND(str(?c_l) AS ?comm_label) .
  BIND(str(?g_l) AS ?gp_label) .
  BIND(str(?r_l) AS ?ra_label) .
  BIND(str(?co_l) AS ?co_label) .
  BIND(str(?e_l) AS ?e_label)
}
  GROUP BY ?person ?dco_id ?label
  ORDER BY ?label
" ;

// Initialize the curl object.
dco_init() ;

// Run the query and pull back the json object
$bindings = runQuery( $query ) ;

// no matter if the bindings are returned or not we close the curl object now
dco_cleanUp() ;

if( $bindings === false )
{
    print( "We were unable to query for the user's profile information<br/>" ) ;
}
else
{

// These divs were pulled from the original view
print( "<div id=\"content-content\" class=\"content-content\">" ) ;
print( "<div id=\"view-id-profile_about_page-page_1\" class=\"view view-profile-about-page view-id-profile_about_page view-display-id-page_1 view-dom-id-1 \">" ) ;
print( "<div class=\"inner content\">" ) ;
print( "<div class=\"view-content\">" ) ;
print( "<div class=\"views-row views-row-1 views-row-odd views-row-first views-row-last\">" ) ;
print( "" ) ;

// Display the name with a link to the dcoid
$dcoid = $bindings[0]->dco_id->value ;
$name = $bindings[0]->label->value ;
print( "<div class=\"views-field-value-1\">" ) ;
print( "<label class=\"views-label-value-1\">" ) ;
print( "Name:" ) ;
print( "</label>" ) ;
print( "<span class=\"field-content\"><a href=\"$dcoid\">$name</a></span>" ) ;
print( "</div>" ) ;
print( "" ) ;

// Display the user's organizations, seperated by a comma
$orguris = explode( "|", $bindings[0]->organization->value ) ;
$orglabels = explode( "|", $bindings[0]->organization_label->value ) ;
print( "<div class=\"views-field-value-5\">" ) ;
print( "<label class=\"views-label-value-5\">" ) ;
print( "Organization:" ) ;
print( "</label>" ) ;
print( "<span class=\"field-content\">" ) ;
for( $i = 0; $i < count( $orguris ); $i++ )
{
    if( $i != 0 ) print( ", " ) ;
    print( "<a href=\"" . $orguris[$i] . "\">" . $orglabels[$i] . "</a>" ) ;
}
print( "</span>" ) ;
print( "</div>" ) ;
print( "" ) ;

// Display the user's emails, separated by a comma
$emaillabels = explode( "|", $bindings[0]->email_label->value ) ;
print( "<div class=\"views-field-value-18\">" ) ;
print( "<label class=\"views-label-value-18\">" ) ;
print( "Public E-mail:" ) ;
print( "</label>" ) ;
print( "<span class=\"field-content\">" ) ;
for( $i = 0; $i < count( $orguris ); $i++ )
{
    if( $i != 0 ) print( ", " ) ;
    print( "<a href=\"mailto:" . $emaillabels[$i] . "\">" . $emaillabels[$i] . "</a>" ) ;
}
print( "</span>" ) ;
print( "</div>" ) ;
print( "" ) ;

// Display the DCO Communities this user is a member of, separated by a comma
$commuris = explode( "|", $bindings[0]->community->value ) ;
$commlabels = explode( "|", $bindings[0]->community_label->value ) ;
print( "<div class=\"views-field-tid\">" ) ;
print( "<label class=\"views-label-tid\">" ) ;
print( "DCO Communities:" ) ;
print( "</label>" ) ;
for( $i = 0; $i < count( $commuris ); $i++ )
{
    if( $i != 0 ) print( ", " ) ;
    print( "<a href=\"" . $commuris[$i] . "\">" . $commlabels[$i] . "</a>" ) ;
}
print( "</div>" ) ;
print( "" ) ;

// Display the DCO Portal Groups this user is a member of, separated by a comma
$groupuris = explode( "|", $bindings[0]->group->value ) ;
$grouplabels = explode( "|", $bindings[0]->group_label->value ) ;
print( "<div class=\"views-field-tid\">" ) ;
print( "<label class=\"views-label-tid\">" ) ;
print( "Portal Groups:" ) ;
print( "</label>" ) ;
for( $i = 0; $i < count( $groupuris ); $i++ )
{
    if( $i != 0 ) print( ", " ) ;
    print( "<a href=\"" . $groupuris[$i] . "\">" . $grouplabels[$i] . "</a>" ) ;
}
print( "</div>" ) ;
print( "" ) ;

// Display the user's areas of expertise, separated by a comma
$experturis = explode( "|", $bindings[0]->expertise->value ) ;
$expertlabels = explode( "|", $bindings[0]->expertise_label->value ) ;
print( "<div class=\"views-field-value-6\">" ) ;
print( "<label class=\"views-label-value-6\">" ) ;
print( "Areas of expertise:" ) ;
print( "</label>" ) ;
print( "<span class=\"field-content\">" ) ;
for( $i = 0; $i < count( $experturis ); $i++ )
{
    if( $i != 0 ) print( ", " ) ;
    print( "<a href=\"" . $experturis[$i] . "\">" . $expertlabels[$i] . "</a>" ) ;
}
print( "</span>" ) ;
print( "</div>" ) ;
print( "" ) ;

// Display the user's home country, should be one
$country = $bindings[0]->country_label->value ;
print( "<div class=\"views-field-value\">" ) ;
print( "<label class=\"views-label-value\">" ) ;
print( "Home Country:" ) ;
print( "</label>" ) ;
print( "<span class=\"field-content\">$country</span>" ) ;
print( "</div>" ) ;
print( "" ) ;

// Display the languages that the user speaks, separated by comma
/*
$langs = explode( "|", $bindings[0]->langs->value ) ;
print( "<div class=\"views-field-value-3\">" ) ;
print( "<label class=\"views-label-value-3\">" ) ;
print( "Language:" ) ;
print( "</label>" ) ;
print( "<span class=\"field-content\">" ) ;
for( $i = 0; $i < count( $langs ); $i++ )
{
    if( $i != 0 ) print( ", " ) ;
    print( $langs[$i] ) ;
}
print( "</span>" ) ;
print( "</div>" ) ;
print( "" ) ;
*/

// Display the user's Skype address, should just be one
/*
$skype = $bindings[0]->skype->value ;
print( "<div class=\"views-field-value-14\">" ) ;
print( "<label class=\"views-label-value-14\">" ) ;
print( "Skype:" ) ;
print( "</label>" ) ;
print( "<span class=\"field-content\">$skype</span>" ) ;
print( "</div>" ) ;
print( "" ) ;
*/
print( "<br/><a href=\"$dcoid\">Additional Information...</a>" ) ;

print( "</div>" ) ;
print( "</div>" ) ;
print( "</div>" ) ;
print( "</div>" ) ;
print( "</div>" ) ;

}
}
?>
