<?php


use Config\Router;

$router = new Router();
$router->get('/upload/{document}', 'RootController@upload');
$router->get('/assets/{assets}', 'RootController@assets');
$router->resource('/user', 'UserController', 'AuthMiddleware');
$router->get('/', 'HomeController@index');

echo $router->handle();