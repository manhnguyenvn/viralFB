<?php

Route::group(['namespace' => 'viralfbpackage\Installer\Http\Controllers'], function() {
    Route::group(['prefix' => 'install'], function() {

    Route::get('/', 'WelcomeController@index');

    });
});