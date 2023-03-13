<?php
/**
 * This page has one job and that's to redirect the URL to the location requested by the URL parameter on the request.
 * This will be recorded within the web log
 */

$url = $_GET["url"];
if(strlen($url) > 0) {
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Location: " . $url);
   
}
exit;
?>