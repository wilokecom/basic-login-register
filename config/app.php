<?php
return [
    'baseURI'    => '/dev.php.com/login-register/',
    'homeURL'    => 'http://localhost:8888/dev.php.com/login-register/',
    'db'         => [
        'mysql' => [
            'database' => 'myproject1',
            'username' => 'root',
            'password' => 'root',
            'host'     => 'localhost'
        ]
    ],
    'navigation' => [
        'login'    => [
            'name'        => 'Login',
            'action'      => 'login',
            'conditional' => ['!isUserLoggedIn']
        ],
        'register' => [
            'name'        => 'Register',
            'action'      => 'register',
            'conditional' => ['!isUserLoggedIn']
        ],
        'logout'   => [
            'name'        => 'Logout',
            'action'      => 'logout',
            'conditional' => ['isUserLoggedIn']
        ],
        'about'    => [
            'name'        => 'About',
            'action'      => 'about',
            'conditional' => ['isTrue']
        ],
        'search'    => [
            'name'        => 'Search',
            'action'      => 'search'
        ]
    ]
];
