<?php

error_reporting( E_ERROR | E_WARNING | E_PARSE ) ;

$curl = null ;
global $curl ;

function dco_init()
{
    global $curl ;

    $curl = curl_init() ;
    curl_setopt( $curl, CURLOPT_POST, false ) ;
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true ) ;
    curl_setopt( $curl, CURLOPT_MAXREDIRS, 5 ) ;
    curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true ) ;
    curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, 5 ) ;
    curl_setopt( $curl, CURLOPT_TIMEOUT, 180 ) ;
}

function xmlize($string) {
    return strtr(
        $string, 
        array(
            "<" => "&lt;",
            ">" => "&gt;",
            '"' => "&quot;",
            "'" => "&apos;",
            "&" => "&amp;",
        )
    );
}

function dco_cleanUp()
{
    global $curl ;

    curl_close($curl);
}

function runESQuery( $query )
{
    $endpoint = "http://localhost:9200/dco/person/_search" ;
    $fullurl = $endpoint . "?q=$query" ;
    return runQuery( $fullurl ) ;
}

function runSPARQLQuery( $query )
{
    // set the post to be the query
    $endpoint = "http://localhost:3030/VIVO/query?output=json" ;
    $fullurl = $endpoint . "&query=".urlencode( $query ) ;
    $j = runQuery( $fullurl ) ;

    $bindings = $j->results->bindings ;
    if( !$bindings )
    {
        if( $tryme == 1 )
        {
            //fwrite( $log, "no bindings in response\n" ) ;
            //fwrite( $log, json_last_error_msg() . "\n" ) ;
            //fwrite( $log, "$content\n" ) ;
            dco_cleanUp() ;
        }
        else
        {
            return runQuery( $query, 1 ) ;
        }
    }
    return $bindings ;
}

function runQuery( $fullurl, $tryme = 0 )
{
    global $curl, $log ;

    //fwrite( $log, "query = $query\n" ) ;
    sleep( 1 ) ;

    //curl_setopt( $curl, CURLOPT_POSTFIELDS, "query=".urlencode( $query ) ) ;
    curl_setopt( $curl, CURLOPT_URL, $fullurl ) ;

    // execute the query
    $content = curl_exec( $curl ) ;

    // inialize here in case there's a problem with the query, or an
    // empty set
    $results = array();

    // get the http status before we close the curl session
    $http_status = curl_getinfo( $curl, CURLINFO_HTTP_CODE ) ;

    // the status should be 200 or 303
    //fwrite( $log, "http_status = $http_status\n" ) ;
	if($http_status != "200" && $http_status != "303")
	{
        if( $tryme == 1 )
        {
            //fwrite( $log, "http_status = $http_status\n" ) ;
            //fwrite( $log, curl_error( $curl ) ) ;
            dco_cleanUp() ;
        }
        else
        {
            return runQuery( $query, 1 ) ;
        }
	}

    if( !$content )
    {
        if( $tryme == 1 )
        {
            //fwrite( $log, "NO CONTENT\n" ) ;
            //fwrite( $log, curl_error( $curl ) ) ;
            dco_cleanUp() ;
        }
        else
        {
            return runQuery( $query, 1 ) ;
        }
    }

    //fwrite( $log, "content = $content\n" ) ;
    $j = json_decode( $content ) ;
    if( !$j )
    {
        if( $tryme == 1 )
        {
            //fwrite( $log, "decode failed\n" ) ;
            //fwrite( $log, json_last_error_msg() ) ;
            //fwrite( $log, "$content\n" ) ;
            dco_cleanUp() ;
        }
        else
        {
            return runQuery( $query, 1 ) ;
        }
    }
    return $j ;
}

if( !function_exists( 'json_last_error_msg' ) )
{
    function json_last_error_msg()
    {
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                echo ' - No errors';
            break;
            case JSON_ERROR_DEPTH:
                echo ' - Maximum stack depth exceeded';
            break;
            case JSON_ERROR_STATE_MISMATCH:
                echo ' - Underflow or the modes mismatch';
            break;
            case JSON_ERROR_CTRL_CHAR:
                echo ' - Unexpected control character found';
            break;
            case JSON_ERROR_SYNTAX:
                echo ' - Syntax error, malformed JSON';
            break;
            case JSON_ERROR_UTF8:
                echo ' - Malformed UTF-8 characters, possibly incorrectly
    encoded';
            break;
            default:
                echo ' - Unknown error';
            break;
        }
    }
}

?>

