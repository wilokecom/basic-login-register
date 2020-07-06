<?php

use Wiloke\Core\App;

session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "vendor/autoload.php";
require_once "functions.php";

//$route = 'login/{postId}/test/{userId}';
//preg_match('/[\w+]/i', 'helloWeAreWiloke123', $aMatches);
//var_export($aMatches);

//$regex = preg_replace_callback('/{[a-zA-z0-9]+}/', function($aMatches) {
//    return '([a-zA-z0-9]+)';
//}, $route);
//
//$url = 'login/1/test/2';
//preg_match('#^'.$regex.'#', $url, $aMatches);
//echo '<pre>';
//var_export($aMatches);die;


require_once "src/Core/Bootstrap.php";
