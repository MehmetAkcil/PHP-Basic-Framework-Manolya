<?php

use Core\Config\Router;

Router::get('/', 'HomeController@index');

Router::get('/upload/{document}', 'HomeController@upload'); //istediginiz bir controlleri burada cagirabilirsiniz. Method dogru girilmesi yeterlidir.
Router::get('/assets/{assets}', 'HomeController@assets'); //istediginiz bir controlleri burada cagirabilirsiniz. Method dogru girilmesi yeterlidir.
Router::resource('/user', 'UserController', 'AuthMiddleware');


echo Router::handle();