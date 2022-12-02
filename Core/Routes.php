<?php


$route = new Route($MainSettings);

$route->add('test', 'AdminController@test');

$route->add("/user/{id}","user.php");

//example route with multiple params

$route->add('/login', 'HomeController@login');
$route->add('/register', 'HomeController@register');

$route->add('/profile', 'UserController@profile');

$route->add('/admin/home', 'AdminController@index');
$route->add('/admin/questions', 'AdminController@questions');
$route->add('/admin/documentation', 'AdminController@documentation');
$route->add('/admin/gamers', 'AdminController@gamers');
$route->add('/admin/questions/edit/{id}', 'AdminController@edit_question');
$route->add('/admin/questions/{pagination}', 'AdminController@question_pagination');
$route->add('/admin/gamers/{pagination}', 'AdminController@gamers_pagination');


$route->add('/home', 'GameController@index');
$route->add('/game', 'GameController@play');


$route->add('/r/admin/login', 'AdminController@login_admin_request');
$route->add('/r/admin/delete/user/{id}', 'AdminController@delete_user');
$route->add('/r/admin/question/edit/{id}', 'AdminController@question_edit');
$route->add('/r/admin/gamer/change_status/{id}', 'AdminController@change_gamer_status');
$route->add('/r/admin/logOut', 'AdminController@logout');

$route->add('/r/user/register', 'HomeController@register_request');
$route->add('/r/user/logOut', 'UserController@logout_user');
$route->add('/r/user/login', 'UserController@login_user');

$route->add('/play/name', 'GameController@play_name');
$route->add('/play', 'GameController@play_game');
$route->add('/play/gone', 'GameController@play_gone');


// error404 page*

$route->notFound("404.php");
