<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

$aArray = ["username" => "wiloke", "password" => "wiloke1", "age" => 18, "username1" => 0];
//$username = "username";
//
//
//if ($aArray["username1"] == false) {
//    echo "This is false value";
//} else {
//    echo "This is not false value";
//}

$aArray[] = "val";

unset($aArray[1]);

echo $aArray["username"];


