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

$aRequires = ['username', 'password', 'email'];

foreach ($aRequires as $required) {
    if (!isset($_POST[$required])) {
        $_SESSION['errors'] = [
            sprintf('The %s is required', $required)
        ];
    
        redirectTo();
    }
}

if (isUserExists($_POST['username'])) {
    $_SESSION['errors'] = [
        sprintf('The username %s is already exists', $_POST['username'])
    ];
    redirectTo();
}

if (isUserExists($_POST['email'])) {
    $_SESSION['errors'] = [
        sprintf('The email %s is already exists', $_POST['email'])
    ];
    redirectTo();
}

$userID = createUser($_POST);

if (!$userID) {
    $_SESSION['errors'] = [
        'We could not create this user! Something went error'
    ];
    redirectTo();
}

setcookie('login_info', [
    'username' => $_POST['username'],
    'password' => $_POST['password']
], time() + 3600, '/', false, false, true);

$_SESSION['logged_in'] = $userID;
redirectTo();

