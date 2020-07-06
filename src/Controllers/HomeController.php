<?php
namespace Wiloke\Controllers;

use Wiloke\Core\Session;
use Wiloke\Models\UserModel;

class HomeController extends AbstractController
{
    public function loadIndex()
    {
        return view('home');
    }
}
