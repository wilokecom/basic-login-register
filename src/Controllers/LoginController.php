<?php
namespace Wiloke\Controllers;

use Wiloke\Core\Redirect;
use Wiloke\Core\Session;
use Wiloke\Models\UserModel;

class LoginController extends AbstractController
{
    private $password;
    
    public function loadIndex()
    {
        return view("login");
    }
    
    private function cryptPassword($password)
    {
        return md5($password);
    }
    
    public function handleLogin()
    {
        if (UserModel::isUserExists($_POST['username'])) {
            echo "Logged In";
            die;
        }
        
        Redirect::to('login');
    }
}
