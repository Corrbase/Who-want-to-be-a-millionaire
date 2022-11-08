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
    'home' => [
        'Controller' => 'GameController',
        'function' => 'index',
    ]

];

$run = new main($Routes, $MainSettings);

$run->Route('admin/home');
