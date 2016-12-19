<?php

use Illuminate\Routing\Router;

Route::group([
    'prefix'        => config('admin.prefix'),
    'namespace'     => Admin::controllerNamespace(),
    'middleware'    => ['web', 'admin'],
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/class', SpecialController::class);
    $router->resource('/video',VideoController::class);
    $router->resource('/up',UpController::class);
    $router->any('/class/uptoken/{id}',"SpecialController@uptoken");
    $router->any('/up/uptoken/{id}',"VideoController@token");
    $router->resource('/test',TestController::class);
    //URL:http://xueyuan.com/admin/class/uptoken/1
   //$router->any('test/uptoken',"TestController@upload");uptoken
   //$router->any('/token',"TestController@token");

});
