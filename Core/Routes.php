<?php


$route = new Route($MainSettings);

//$route->add('test', 'AdminController@test');
// ---------------------- armenian pages
$route->add('hy/login', 'HomeController@login');
$route->add('hy/register', 'HomeController@register');
$route->add('hy/profile', 'UserController@profile');
$route->add('hy/user/wins/{pagination}', 'UserController@games_pagination');
$route->add('hy/home', 'homeCOntroller@home');
$route->add('hy/game', 'GameController@play');

// ---------------------- admin en pages
$route->add('en/admin/home', 'AdminController@index');
$route->add('en/admin/questions', 'AdminController@questions');
$route->add('en/admin/documentation', 'AdminController@documentation');
$route->add('en/admin/gamers', 'AdminController@gamers');
$route->add('en/admin/users', 'AdminController@users');
$route->add('en/admin/user/edit/{id}', 'AdminController@edit_user');
$route->add('en/admin/users/add', 'AdminController@add_user');
$route->add('en/admin/questions/edit/{id}', 'AdminController@edit_question');
$route->add('en/admin/questions/create', 'AdminController@create_question');
$route->add('en/admin/questions/{pagination}', 'AdminController@question_pagination');
$route->add('en/admin/users/{pagination}', 'AdminController@admins_pagination');
$route->add('en/admin/gamers/{pagination}', 'AdminController@gamers_pagination');

// ---------------------- admin hy pages
$route->add('hy/admin/home', 'AdminController@index');
$route->add('hy/admin/questions', 'AdminController@questions');
$route->add('hy/admin/documentation', 'AdminController@documentation');
$route->add('hy/admin/gamers', 'AdminController@gamers');
$route->add('hy/admin/users', 'AdminController@users');
$route->add('hy/admin/user/edit/{id}', 'AdminController@edit_user');
$route->add('hy/admin/users/add', 'AdminController@add_user');
$route->add('hy/admin/questions/edit/{id}', 'AdminController@edit_question');
$route->add('hy/admin/questions/create', 'AdminController@create_question');
$route->add('hy/admin/questions/{pagination}', 'AdminController@question_pagination');
$route->add('hy/admin/users/{pagination}', 'AdminController@admins_pagination');
$route->add('hy/admin/gamers/{pagination}', 'AdminController@gamers_pagination');




// ---------------------- english pages

$route->add('en/home', 'homeCOntroller@home');
$route->add('en/login', 'HomeController@login');
$route->add('en/register', 'HomeController@register');
$route->add('en/profile', 'UserController@profile');

$route->add('en/game', 'GameController@play');


$route->add('en/user/get_money/{id}', 'UserController@get_money');

// ---------------------- requests

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

$route->add('en/user/wins/{pagination}', 'UserController@games_pagination');
$route->add('hy/user/get_money/{id}', 'UserController@get_money');
// ---------------------- game



$route->add('hy/play/name', 'GameController@play_name');
$route->add('hy/play', 'GameController@play_game');
$route->add('hy/play/gone', 'GameController@play_gone');

$route->add('en/play/name', 'GameController@play_name');
$route->add('en/play', 'GameController@play_game');
$route->add('en/play/gone', 'GameController@play_gone');


// error404 page*

$route->notFound("404.php");
