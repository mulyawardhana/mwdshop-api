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
    // USER ROUTING
    $router->get('users', 'Master\UserController@index');
    $router->post('users', 'Master\UserController@store');
    $router->get('users/{id}', 'Master\UserController@show');
    $router->patch('users/{id}', 'Master\UserController@update');
    // END
    // USER CATEGORY
    $router->get('category', 'Master\CategoryController@index');
    $router->post('category', 'Master\CategoryController@store');
    $router->get('category/{id}', 'Master\CategoryController@show');
    $router->patch('category/{id}', 'Master\CategoryController@update');
    // END

     // USER CATEGORY
    $router->get('product', 'Master\ProductController@index');
    $router->post('product/search', 'Master\ProductController@index');
    $router->post('product', 'Master\ProductController@store');
     // END
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
