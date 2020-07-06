<?php
$oRoute->get('', 'Wiloke\Controllers\HomeController@loadIndex');
$oRoute->get('home', 'Wiloke\Controllers\HomeController@loadIndex');
$oRoute->get('register', 'Wiloke\Controllers\RegisterController@loadIndex');
$oRoute->post('register', 'Wiloke\Controllers\RegisterController@handleRegister');
$oRoute->get('login', 'Wiloke\Controllers\LoginController@loadIndex');
$oRoute->get('logout', 'Wiloke\Controllers\LogoutController@handleLogout');
//$oRoute->get('login/123', 'Wiloke\Controllers\LoginController@loadIndex');
//$oRoute->get('login/{userId}', 'Wiloke\Controllers\LoginController@loadIndex');
//$oRoute->get('login/{userId}/vuong/don/hieu/{php}', 'Wiloke\Controllers\LoginController@testParam');
$oRoute->post('login', 'Wiloke\Controllers\LoginController@handleLogin');
$oRoute->get('about', 'Wiloke\Controllers\AboutController@loadAbout');
$oRoute->get('profile/{userId}', 'Wiloke\Controllers\ProfileController@loadIndex');
$oRoute->get('search', 'Wiloke\Controllers\SearchController@loadIndex');
$oRoute->get('search/{keyword}', 'Wiloke\Controllers\SearchController@handleSearch');
