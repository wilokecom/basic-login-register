<?php

namespace Wiloke\Core;

class Session
{
    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }
    
    public static function setCurrentUserLoggedIn($userId)
    {
        $_SESSION['user-logged-in'] = $userId;
    }
    
    public static function destroyAll()
    {
        session_destroy();
    }
    
    public static function destroy($key)
    {
        unset($_SESSION[$key]);
    }
    
    public static function logoutCurrentUser()
    {
        self::destroy('user-logged-in');
    }
    
    public static function getCurrentUserLoggedIn()
    {
        return isset($_SESSION['user-logged-in']) ? $_SESSION['user-logged-in'] : false;
    }
    
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
    }
}
