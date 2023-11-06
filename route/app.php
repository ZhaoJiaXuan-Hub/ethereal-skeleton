<?php
/** @var Route $router */

use Ethereal\Route;

$router->get('/hello',function (){
    return response("你好,世界!");
})->middleware(\App\middleware\DefaultMiddleware::class);

$router->get('/','IndexController@index');
$router->get('/json','IndexController@json');
$router->get('/view','IndexController@view');