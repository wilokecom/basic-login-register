<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * @var $db mysqli
 */
global $db;

unset($_SESSION['errors']);

$GLOBALS['aConfigs'] = require_once "config/app.php";
require_once "database/create-database.php";
require_once "database/connection.php";
require_once "functions.php";
$db = makeConnection();

$aRequires = ['username', 'password'];

foreach ($aRequires as $required) {
    if (!isset($_POST[$required])) {
        $_SESSION['errors'] = [
            sprintf('The %s is required', $required)
        ];
        
        redirectTo();
    }
}

$oUser = handleLogin($_POST);
if (!$oUser) {
    $_SESSION['errors'] = [
        'Invalid username / password'
    ];
    redirectTo();
}

$_SESSION['logged_in'] = $oUser->ID;

redirectTo();
