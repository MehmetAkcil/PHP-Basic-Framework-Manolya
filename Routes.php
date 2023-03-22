<?php
use Config\Router;

$router = new Router();
$router->get('/upload/{document}', 'HomeController@upload'); //istediginiz bir controlleri burada cagirabilirsiniz. Method dogru girilmesi yeterlidir.
$router->get('/assets/{assets}', 'HomeController@assets'); //istediginiz bir controlleri burada cagirabilirsiniz. Method dogru girilmesi yeterlidir.
$router->resource('/user', 'UserController', 'AuthMiddleware');
$router->get('/', 'HomeController@index');

echo $router->handle();