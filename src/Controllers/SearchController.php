<?php

namespace Wiloke\Controllers;

use Wiloke\Core\Database\QueryBuilder;

class SearchController
{
    public function loadIndex()
    {
        $aSearchValues = [];
        if (isset($_GET['s'])) {
            $aSearchValues = QueryBuilder::table('users')->where('username', $_GET['s'])->get();
            if (!$aSearchValues) {
                echo QueryBuilder::getError();die;
            }
        }
//        var_export($aSearchValues);die;
        view('search');
    }
}
