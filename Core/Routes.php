<?php
$Routes = [
    'admin/admin' => [
        'Controller' => 'AdminController',
    'function' => 'index',
    ],
    'admin/home' => [
        'Controller' => 'AdminController',
        'function' => 'index',
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
