<?php
namespace Wiloke\Core\Database;

use Wiloke\Core\App;

class Connection
{
    /**
     *
     * @return \mysqli
     * @throws \Exception
     */
    public static function make()
    {
        $oMysqli = new \mysqli(
            App::get('config/app')['db']['mysql']['host'],
            App::get('config/app')['db']['mysql']['username'],
            App::get('config/app')['db']['mysql']['password'],
            App::get('config/app')['db']['mysql']['database']
        );
        
        if ($oMysqli->connect_errno) {
            throw new \Exception($oMysqli->connect_error);
        }
        
        return $oMysqli;
    }
}
