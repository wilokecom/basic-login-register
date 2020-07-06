<?php

namespace Wiloke\Core;

class Request
{
    private static $aParseRequest = [];
    
    public static function parseUrl()
    {
        return trim(parse_url(
            $_SERVER['REQUEST_URI'],
            PHP_URL_PATH
        ));
    }
    
    public static function uri()
    {
        if (empty(self::$aParseRequest)) {
            self::$aParseRequest = str_replace(
                App::get('config/app')['baseURI'],
                '',
                self::parseUrl()
            );
        }
        
        return self::$aParseRequest;
    }
    
    public static function reset()
    {
        self::$aParseRequest = [];
    }
    
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    
    public static function getRoute()
    {
        self::uri();
        
        return self::$aParseRequest[0];
    }
    
    public static function getParams()
    {
        self::uri();
        
        $aRequest = self::$aParseRequest;
        unset($aRequest[0]);
        
        return $aRequest;
    }
}
