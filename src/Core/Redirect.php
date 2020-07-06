<?php

namespace Wiloke\Core;

class Redirect
{
    public static function to($url)
    {
        header('Location: '.url($url));
        exit();
    }
}
