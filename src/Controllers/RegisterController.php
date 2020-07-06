<?php

namespace Wiloke\Controllers;

use Wiloke\Core\Redirect;
use Wiloke\Core\Session;
use Wiloke\Models\UserModel;

class RegisterController
{
    public function loadIndex()
    {
        return view("register");
    }
    
    public function handleRegister()
    {
        if (!UserModel::isUserExists($_POST['username']) && !UserModel::isUserExists($_POST['email'])) {
            $userId = UserModel::createUser($_POST['username'], $_POST['email'], $_POST['password']);
            if ($userId) {
                Session::destroy('register-error');
                Session::setCurrentUserLoggedIn($userId);
                Redirect::to('profile/'.$userId);
            } else {
                Session::set('register-error', 'We could not insert this username to database');
                Redirect::to('register');
            }
        } else {
            Session::set('register-error', 'The username or email are already exists');
            Redirect::to('register');
        }
    }
}
