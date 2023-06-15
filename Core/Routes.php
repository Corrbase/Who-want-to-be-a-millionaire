<?php


$route = new Route($MainSettings);

//$route->add('test', 'AdminController@test');
// ---------------------- armenian pages

//guest
$route->add('hy/login', 'HomeController@login');
$route->add('hy/register', 'HomeController@register');
$route->add('hy/home', 'homeController@home');

$route->add('hy/profile', 'UserController@profile');
$route->add('hy/user/wins/{pagination}', 'UserController@gamesPagination');

// ---------------------- admin en pages
$route->add('en/admin/home', 'AdminController@index');
$route->add('en/admin/documentation', 'AdminController@documentation');

$route->add('en/admin/games', 'AdminController@games');
$route->add('en/admin/games/{pagination}', 'AdminController@gamesPagination');

$route->add('en/admin/users', 'AdminController@users');
$route->add('en/admin/user/edit/{id}', 'AdminController@editUser');
$route->add('en/admin/users/add', 'AdminController@addUser');
$route->add('en/admin/users/{pagination}', 'AdminController@usersPagination');

$route->add('en/admin/questions', 'AdminController@questions');
$route->add('en/admin/questions/create', 'AdminController@createQuestion');
$route->add('en/admin/questions/edit/{id}', 'AdminController@editQuestion');
$route->add('en/admin/questions/pagination', 'AdminController@questionPagination');

// ---------------------- admin hy pages
$route->add('hy/admin/home', 'AdminController@index');
$route->add('hy/admin/documentation', 'AdminController@documentation');

$route->add('hy/admin/games', 'AdminController@games');
$route->add('hy/admin/games/pagination', 'AdminController@gamesPagination');

$route->add('hy/admin/users', 'AdminController@users');
$route->add('hy/admin/users/add', 'AdminController@addUser');
$route->add('hy/admin/users/pagination', 'AdminController@usersPagination');
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

$route->add('/r/admin/users/add', 'AdminController@requestAddUserRequest');
$route->add('/r/admin/delete/user/{id}', 'AdminController@requestDeleteUser');
$route->add('/r/admin/user/edit/{id}', 'AdminController@requestUserEdit');

$route->add('/r/admin/question/edit/{id}', 'AdminController@requestQuestionEdit');
$route->add('/r/admin/question/create', 'AdminController@requestQuestionCreate');

$route->add('/r/admin/game/change_status/{id}', 'AdminController@requestChangeGamerStatus');

$route->add('/r/admin/logOut', 'AdminController@requestLogout');


$route->add('/r/user/register', 'HomeController@registerRequest');
$route->add('/r/user/logOut', 'UserController@logoutUser');
$route->add('/r/user/login', 'UserController@loginRequest');

$route->add('en/user/wins/pagination', 'UserController@gamesPagination');
$route->add('hy/user/get_money/{id}', 'UserController@get_money');
// ---------------------- game

$route->add('hy/game', 'GameController@index');
$route->add('en/game', 'GameController@index');


$route->add('hy/play/name', 'GameController@createGame');
$route->add('hy/play', 'GameController@game');
$route->add('hy/play/gone', 'GameController@gameBackend');

$route->add('en/play/name', 'GameController@createGame');
$route->add('en/play', 'GameController@game');
$route->add('en/play/gone', 'GameController@gameBackend');


// error404 page*

$route->notFound("404.php");
