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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group([
    'prefix' => 'users',
], function() use($router){
    $router->get('/', 'UserController@getAll');
    $router->get('/{id}', 'UserController@getById');
    $router->post('/', 'UserController@store');
    $router->put('/{id}', 'UserController@update');
    $router->delete('/{id}', 'UserController@delete');
});

$router->group([
    'prefix' => 'auth',
], function() use($router){
    $router->get('/user', 'AuthController@userLogin');
    $router->get('/refresh', 'AuthController@refresh');
    $router->post('/login', 'AuthController@login');
    $router->post('/logout', 'AuthController@logout');
});
