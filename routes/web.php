<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});



$router->group(["prefix" => "api/v1"],function () use ($router){

    $router->group(["prefix" => "oauth"], function () use ($router){

        $router->post("token","\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken");

    });

    $router->group(["middleware" => ["auth:api","cors"]],function () use ($router) {

        //user
        $router->get("users","UserController@show");

        $router->get("users/user/{id}","UserController@showUser");

        $router->post("users/add","UserController@add");

        $router->put("users/update/{id}","UserController@update");

        $router->delete("users/delete/{id}","UserController@softDelete");

    });

});
