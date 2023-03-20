<?php


$route = new Route($MainSettings);

//$route->add('test', 'AdminController@test');

$route->add('hy/login', 'HomeController@login');
$route->add('hy/register', 'HomeController@register');
$route->add('hy/profile', 'UserController@profile');


$route->add('/admin/home', 'AdminController@index');
$route->add('/admin/questions', 'AdminController@questions');
$route->add('/admin/documentation', 'AdminController@documentation');
$route->add('/admin/gamers', 'AdminController@gamers');
$route->add('/admin/users', 'AdminController@users');
$route->add('/admin/user/edit/{id}', 'AdminController@edit_user');
$route->add('/admin/users/add', 'AdminController@add_user');
$route->add('/admin/questions/edit/{id}', 'AdminController@edit_question');
$route->add('/admin/questions/create', 'AdminController@create_question');
$route->add('/admin/questions/{pagination}', 'AdminController@question_pagination');
$route->add('/admin/users/{pagination}', 'AdminController@admins_pagination');
$route->add('/admin/gamers/{pagination}', 'AdminController@gamers_pagination');

$route->add('hy/user/get_money/{id}', 'UserController@get_money');
$route->add('hy/user/wins/{pagination}', 'UserController@games_pagination');



$route->add('hy/home', 'homeCOntroller@home');
$route->add('hy/game', 'GameController@play');

// english pages

$route->add('en/home', 'homeCOntroller@home');
$route->add('en/login', 'HomeController@login');
$route->add('en/register', 'HomeController@register');
$route->add('en/profile', 'UserController@profile');

$route->add('en/game', 'GameController@play');

$route->add('en/user/wins/{pagination}', 'UserController@games_pagination');
$route->add('en/user/get_money/{id}', 'UserController@get_money');


$route->add('/r/admin/login', 'AdminController@login_admin_request');
$route->add('/r/admin/users/add', 'AdminController@add_user_request');
$route->add('/r/admin/delete/user/{id}', 'AdminController@delete_user');
$route->add('/r/admin/question/edit/{id}', 'AdminController@question_edit');
$route->add('/r/admin/user/edit/{id}', 'AdminController@user_edit');
$route->add('/r/admin/question/create', 'AdminController@question_create');
$route->add('/r/admin/gamer/change_status/{id}', 'AdminController@change_gamer_status');
$route->add('/r/admin/logOut', 'AdminController@logout');

$route->add('/r/user/register', 'HomeController@register_request');
$route->add('/r/user/logOut', 'UserController@logout_user');
$route->add('/r/user/login', 'UserController@login_user');

$route->add('hy/play/name', 'GameController@play_name');
$route->add('hy/play', 'GameController@play_game');
$route->add('hy/play/gone', 'GameController@play_gone');

$route->add('en/play/name', 'GameController@play_name');
$route->add('en/play', 'GameController@play_game');
$route->add('en/play/gone', 'GameController@play_gone');


// error404 page*

$route->notFound("404.php");
