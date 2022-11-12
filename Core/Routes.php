<?php
$Routes = [
    'test' => [
        'Controller' => 'AdminController',
        'function' => 'test',
    ],
    'admin/login' => [
        'Controller' => 'AdminController',
        'function' => 'login',
    ],
    'admin/home' => [
        'Controller' => 'AdminController',
        'function' => 'index',
    ],
    'r/admin/login' => [
        'Controller' => 'AdminController',
        'function' => 'login_request',
    ],

    // game

    'home' => [
        'Controller' => 'GameController',
        'function' => 'index',
    ],
    'play' => [
        'Controller' => 'GameController',
        'function' => 'play',
    ],


    // posts

    'play/1' => [
        'Controller' => 'GameController',
        'function' => 'play_1',
    ]


];

$run = new main($Routes, $MainSettings);

$run->Route('admin/home');
