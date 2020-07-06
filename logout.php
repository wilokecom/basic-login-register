<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$GLOBALS['aConfigs'] = require_once "config/app.php";
require_once "functions.php";
unset($_SESSION['logged_in']);

redirectTo();
