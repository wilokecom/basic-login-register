<?php

namespace Wiloke\Models;

use Wiloke\Core\Database\QueryBuilder;
use Wiloke\Core\Session;

class UserModel
{
    public static function isUserExists($usernameOrEmail)
    {
        $aUserInfo = QueryBuilder::table('users')
                                 ->select('email', 'username')
                                 ->where('email', $usernameOrEmail)
                                 ->orWhere('username', $usernameOrEmail)
                                 ->first()
        ;
        return isset($aUserInfo['email']);
    }
    
    public static function createUser($username, $email, $password)
    {
        $password = md5($password);
        
        $status = QueryBuilder::table('users')
                              ->insert([
                                  'username' => $username,
                                  'email'    => $email,
                                  'password' => $password
                              ])
        ;
        
        if (!$status) {
            return $status;
        }
        
        return QueryBuilder::getId();
    }
    
    public static function getUserById($userId)
    {
        return QueryBuilder::table('users')
                           ->where('ID', $userId)
                           ->first()
            ;
    }
}
