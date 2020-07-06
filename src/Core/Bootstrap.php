<?php
namespace Wiloke\Core;

App::bind('config/app', require_once "config/app.php");
App::bind('Validation', new Validation());

Router::load('config/route.php')->direct(
    Request::uri(),
    Request::method()
)
;
