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

// ==========================================
// CERVEXA API ROUTES
// ==========================================
$router->group(['prefix' => 'api/v2/cervexa', 'namespace' => 'Cervexa'], function () use ($router) {
    
    // Auth Routes
    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'AuthController@register');
    $router->post('/logout', 'AuthController@logout');
    $router->get('/me', 'AuthController@me');

    // Patient Routes
    $router->get('/patients', 'PatientController@index');
    $router->post('/patients', 'PatientController@store');
    $router->get('/patients/{id}', 'PatientController@show');
    $router->put('/patients/{id}', 'PatientController@update');
    $router->delete('/patients/{id}', 'PatientController@destroy');

    // Session Routes
    $router->get('/sessions', 'SessionController@index');
    $router->post('/sessions', 'SessionController@store');
    $router->get('/sessions/{id}', 'SessionController@show');
    $router->put('/sessions/{id}', 'SessionController@update');
    $router->delete('/sessions/{id}', 'SessionController@destroy');

    // Media Routes
    $router->get('/media', 'MediaController@index');
    $router->post('/media', 'MediaController@store');
    $router->get('/media/{id}', 'MediaController@show');
    $router->delete('/media/{id}', 'MediaController@destroy');
});
