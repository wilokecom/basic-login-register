<?php

namespace Wiloke\Controllers;

use Wiloke\Core\Redirect;
use Wiloke\Core\Session;

class LogoutController
{
    public function handleLogout()
    {
        Session::logoutCurrentUser();
        
        Redirect::to('home');
    }
}
