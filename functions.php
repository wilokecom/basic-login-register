<?php

use \Wiloke\Core\App;

if (!function_exists('view')) {
    /**
     * @param $file
     *
     * @return mixed
     */
    function view($file, $aWith = [])
    {
        extract($aWith);
        
        return include "views/".$file.".php";
    }
}

if (!function_exists('escUrl')) {
    /**
     * @param $file
     *
     * @return mixed
     */
    function escUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}

if (!function_exists('escHtml')) {
    function escHtml($text)
    {
        return filter_var($text, FILTER_SANITIZE_STRING);
    }
}

if (!function_exists('addQueryArgs')) {
    function addQueryArgs(array $aQuery, $url = '')
    {
        $url = empty($url) ? App::get('config/app')['homeURL'] : $url;
        
        return http_build_query($aQuery, $url);
    }
}

if (!function_exists('isUserLoggedIn')) {
    function isUserLoggedIn()
    {
        return isset($_SESSION['logged_in']) && !empty($_SESSION['logged_in']);
    }
}

function isTrue()
{
    return true;
}

if (!function_exists('url')) {
    function url($path = '')
    {
        if (App::get('URL')) {
            $oURL = App::get('URL');
        } else {
            $oURL = new \Wiloke\Core\URL();
            App::bind('URL', $oURL);
        }
        
        if (empty($path)) {
            return $oURL;
        }
        
        return $oURL->url($path);
    }
}
