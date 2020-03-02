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

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router){
    $router->post('ocorrencias', 'OcorrenciasController@store');
    $router->get('ocorrencias', 'OcorrenciasController@index');
    $router->get('ocorrencias/{id}', 'OcorrenciasController@show');
    $router->put('ocorrencias/{id}', 'OcorrenciasController@update');
    $router->delete('ocorrencias/{id}', 'OcorrenciasController@destroy');
});

$router->post('/api/login', 'TokenController@gerarToken');