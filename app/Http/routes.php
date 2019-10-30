<?php

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'DsController@home');
    Route::get('sity/{location}', 'DsController@sity');
    Route::get('Ds/update', 'DsController@update');
    Route::any('Map/{action}', 'DsController@map');

    Route::get('Vacation/Management', 'VacationController@management');
    Route::post('Vacation/Add', 'VacationController@add');
    Route::post('Vacation/AddTable', 'VacationController@addTable');
    Route::delete('Vacation', 'VacationController@delete');
    Route::get('Vacation/Edit', 'VacationController@edit');

    Route::resource('Tables/engineers', 'Table\EngineersController', ['only' => [
        'index', 'store', 'update', 'destroy'
    ]]);

    Route::resource('Tables/rf', 'Table\RfController', ['only' => [
        'index', 'store', 'update', 'destroy'
    ]]);

    Route::resource('Tables/vc', 'Table\VcController', ['only' => [
        'index', 'store', 'update', 'destroy'
    ]]);

    Route::resource('Tables/Alternate', 'Table\AlternateController', ['only' => [
        'index', 'store', 'update', 'destroy'
    ]]);


    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/message', ['uses'=>'MessageController@create']);
    Route::get('/Message', ['uses'=>'MessageController@create']);
    Route::get('/Message/create', ['as'=>'create','uses'=>'MessageController@create']);
    Route::get('/Message/workers', ['as'=>'workers','uses'=>'MessageController@workers']);
    Route::get('/Message/statistic', ['as'=>'statistic','uses'=>'MessageController@statistic']);
    Route::post('/Message/add', ['as'=>'add','uses'=>'MessageController@add']);
    Route::post('/Message/delete', ['as'=>'delete','uses'=>'MessageController@delete']);
    Route::post('/Message/send', ['as'=>'send','uses'=>'MessageController@send']);
    Route::post('/Message/logout', ['as'=>'logout','uses'=>'MessageController@logout']);
});

Route::auth();
//Route::get('/home', 'HomeController@index');

