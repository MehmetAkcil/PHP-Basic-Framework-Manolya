<?php


$router = new Router();

$router->resource('/user', 'UserController', 'AuthMiddleware');
$router->get('/', 'HomeController@index');

echo $router->handle();