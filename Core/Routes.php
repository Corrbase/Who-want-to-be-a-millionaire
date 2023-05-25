<?php


$route = new Route($MainSettings);

//$route->add('test', 'AdminController@test');
// ---------------------- armenian pages

//guest
$route->add('hy/login', 'HomeController@login');
$route->add('hy/register', 'HomeController@register');
$route->add('hy/home', 'homeController@home');

$route->add('hy/profile', 'UserController@profile');
$route->add('hy/user/wins/{pagination}', 'UserController@games_pagination');

// ---------------------- admin en pages
$route->add('en/admin/home', 'AdminController@index');
$route->add('en/admin/documentation', 'AdminController@documentation');

$route->add('en/admin/gamers', 'AdminController@gamers');
$route->add('en/admin/gamers/{pagination}', 'AdminController@gamersPagination');

$route->add('en/admin/users', 'AdminController@users');
$route->add('en/admin/user/edit/{id}', 'AdminController@editUser');
$route->add('en/admin/users/add', 'AdminController@addUser');
$route->add('en/admin/users/{pagination}', 'AdminController@usersPagination');

$route->add('en/admin/questions', 'AdminController@questions');
$route->add('en/admin/questions/create', 'AdminController@createQuestion');
$route->add('en/admin/questions/edit/{id}', 'AdminController@editQuestion');
$route->add('en/admin/questions/{pagination}', 'AdminController@questionPagination');

// ---------------------- admin hy pages
$route->add('hy/admin/home', 'AdminController@index');
$route->add('hy/admin/documentation', 'AdminController@documentation');

$route->add('hy/admin/gamers', 'AdminController@gamers');
$route->add('hy/admin/gamers/{pagination}', 'AdminController@gamersPagination');

$route->add('hy/admin/users', 'AdminController@users');
$route->add('hy/admin/users/add', 'AdminController@addUser');
$route->add('hy/admin/users/{pagination}', 'AdminController@usersPagination');
$route->add('hy/admin/user/edit/{id}', 'AdminController@editUser');

$route->add('hy/admin/questions', 'AdminController@questions');
$route->add('hy/admin/questions/create', 'AdminController@createQuestion');
$route->add('hy/admin/questions/edit/{id}', 'AdminController@editQuestion');
$route->add('hy/admin/questions/{pagination}', 'AdminController@questionPagination');

// ---------------------- english pages

$route->add('en/home', 'homeCOntroller@home');
$route->add('en/login', 'HomeController@login');
$route->add('en/register', 'HomeController@register');
$route->add('en/profile', 'UserController@profile');

$route->add('en/user/get_money/{id}', 'UserController@get_money');

// ---------------------- requests

$route->add('/r/admin/users/add', 'AdminController@addUserRequest');
$route->add('/r/admin/delete/user/{id}', 'AdminController@deleteUser');
$route->add('/r/admin/user/edit/{id}', 'AdminController@userEdit');

$route->add('/r/admin/question/edit/{id}', 'AdminController@questionEdit');
$route->add('/r/admin/question/create', 'AdminController@questionCreate');

$route->add('/r/admin/gamer/change_status/{id}', 'AdminController@changeGamerStatus');

$route->add('/r/admin/logOut', 'AdminController@logout');


$route->add('/r/user/register', 'HomeController@registerRequest');
$route->add('/r/user/logOut', 'UserController@logout_user');
$route->add('/r/user/login', 'UserController@login_user');

$route->add('en/user/wins/{pagination}', 'UserController@games_pagination');
$route->add('hy/user/get_money/{id}', 'UserController@get_money');
// ---------------------- game

$route->add('hy/game', 'GameController@index');
$route->add('en/game', 'GameController@index');


$route->add('hy/play/name', 'GameController@play_backend');
$route->add('hy/play', 'GameController@play_game');
$route->add('hy/play/gone', 'GameController@play_gone');

$route->add('en/play/name', 'GameController@play_backend');
$route->add('en/play', 'GameController@play_game');
$route->add('en/play/gone', 'GameController@play_gone');


// error404 page*

$route->notFound("404.php");
