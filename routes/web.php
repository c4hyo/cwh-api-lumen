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
$router->group(['middleware'=>'cors'],function()use($router){
    $router->group(['prefix'=>'pengguna'],function() use($router){
        $router->get('/','PenggunaController@index');
        $router->post('/login','PenggunaController@login');
        $router->get('/{id}','PenggunaController@detail');
        $router->delete('/{id}','PenggunaController@delete');
        $router->put('/{id}','PenggunaController@update');
        $router->put('/{id}/password','PenggunaController@changePass');
        $router->post('/volunteer','PenggunaController@createVolunteer');
        $router->get('/role/volunteer','PenggunaController@indexVolunteer');
        $router->post('/admin','PenggunaController@createAdmin');
        $router->get('/role/admin','PenggunaController@indexAdmin');
    });
    $router->group(['prefix'=>'event'],function()use ($router){
        $router->get('/','EventController@index');
        $router->post('/','EventController@create');
        $router->get('/{id}','EventController@detail');
        $router->put('/{id}','EventController@update');
        $router->delete('/{id}','EventController@delete');
    });
    $router->group(['prefix'=>'posting'],function()use ($router){
        $router->get('/','PostingController@index');
        $router->post('/','PostingController@create');
        $router->get('/{id}','PostingController@detail');
        $router->get('/{id}/post','PostingController@postBy');
        $router->put('/{id}','PostingController@update');
        $router->delete('/{id}','PostingController@delete');
    });
});