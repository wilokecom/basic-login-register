<?php

namespace Wiloke\Controllers;

use Wiloke\Core\Session;
use Wiloke\Models\UserModel;

class ProfileController
{
    public function loadIndex($userId)
    {
        $aUserInfo = UserModel::getUserById($userId);
        return view("profile", $aUserInfo);
    }
}
