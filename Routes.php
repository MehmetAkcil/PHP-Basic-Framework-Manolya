<?php

use Core\Config\Router;

Router::get('/', 'HomeController@index');
Router::get('/test', 'HomeController@test');

Router::get('/upload/{document}', 'HomeController@upload'); //istediginiz bir controlleri burada cagirabilirsiniz. Method dogru girilmesi yeterlidir.
Router::get('/assets/{assets}', 'HomeController@assets'); //istediginiz bir controlleri burada cagirabilirsiniz. Method dogru girilmesi yeterlidir.
Router::resource('/user', 'UserController', 'AuthMiddleware');


Router::group('/tesxt', static function () {
    Router::get('', 'HomeController@test');
    Router::get('/{id}', 'HomeController@test2');
});


echo Router::handle();