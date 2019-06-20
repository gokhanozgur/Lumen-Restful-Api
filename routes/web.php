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


$api = app("Dingo\Api\Routing\Router");

$api->version("v1",function ($api){

    $api->group(["prefix" => "oauth"], function ($api){

        $api->post("token","\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken");

    });

    $api->group(["namespace" => "App\Http\Controllers","middleware" => ["auth:api","cors"]],function ($api){

        //user get
        $api->get("users","UserController@show");

        $api->post("users/add","UserController@add");

        $api->put("users/update/{id}","UserController@update");

        $api->delete("users/delete/{id}","UserController@delete");

    });

});
