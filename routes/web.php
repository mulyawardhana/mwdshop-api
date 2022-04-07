<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
// $router->group(['middleware' => 'cors','prefix' => 'api'], function () use ($router) {
    $router->group(['middleware' => 'auth','prefix' => 'api'], function () use ($router) {
    //All the routes you want to allow CORS for
    $router->get('users', 'Master\UserController@index');
    $router->post('users', 'Master\UserController@store');
    $router->get('users/{id}', 'Master\UserController@show');
    $router->patch('users/{id}', 'Master\UserController@update');
    $router->get('me', 'AuthController@me');
  });
// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// $router->group(['middleware' => 'auth','prefix' => 'api'], function ($router)
// {
//     $router->get('me', 'AuthController@me');
// });



$router->group(['middleware' => 'cors','prefix' => 'api'], function () use ($router)
{
   $router->post('register', 'AuthController@register');
   $router->post('login', 'AuthController@login');
});
