<?php


$route = new Route($MainSettings);

$route->add('test', 'AdminController@test');

$route->add("/user/{id}","user.php");

//example route with multiple params
$route->add("/download/{downID}/{filename}","download.php");
$route->add('admin/login', 'AdminController@login');
$route->add('admin/home', 'AdminController@index');
$route->add('admin/questions', 'AdminController@questions');
$route->add('admin/questions/{pagination}', 'AdminController@pagination');
$route->add('admin/questions/edit/{id}', 'AdminController@edit_question');


$route->add('home', 'GameController@index');
$route->add('game', 'GameController@play');


$route->add('r/admin/login', 'AdminController@login_request');
$route->add('r/admin/delete/user/{id}', 'AdminController@delete_user');
$route->add('/r/admin/question/edit/{id}', 'AdminController@question_edit');

$route->add('play/name', 'GameController@play_name');
$route->add('play', 'GameController@play_game');
$route->add('play/gone', 'GameController@play_gone');


// error404 page*

$route->notFound("404.php");
