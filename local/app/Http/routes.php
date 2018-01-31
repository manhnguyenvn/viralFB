<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Dashboard routes
Route::get('/vf-admin', function () {
    return redirect('/dashboard');
});
Route::get('/dashboard/login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::post('/dashboard/handleLogin', ['as' => 'handleLogin', 'uses' => 'AuthController@handleLogin']);
Route::get('/dashboard/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);


Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', 'AdminController@dashboardIndex');
//Update page
   Route::get('dashboard/update', 'AdminController@showUpdate');
   Route::post('dashboard/update/makeupdate', 'AdminController@makeUpdate');

//Configuration routes
    Route::get('dashboard/configuration', 'AdminController@showConfig');
    Route::post('/dashboard/configuration/save', 'AdminController@addConfig');

//Activate warning app routes
    Route::get('/dashboard/plugins', 'AdminController@showPlugins');


//Activate warning app routes
    Route::get('/dashboard/activate', 'AdminController@showActivate');

//Activate app routes
    Route::post('/dashboard/save', 'AdminController@addPk');

//Aplications routes
    Route::get('/dashboard/apps/list', 'AdminController@showAppsList');
    Route::post('/dashboard/apps/delete', 'AdminController@deleteApp');


    Route::get('/dashboard/apps/create/detalies', 'AdminController@showCreateAppDetails');
    Route::post('/dashboard/apps/create/savedetalies', 'AppController@createAppDetails');
    Route::get('/dashboard/apps/create/results', 'AdminController@showCreateAppResults');
    Route::post('dashboard/apps/create/results/delete', 'AdminController@deleteResult');
    Route::post('/dashboard/apps/create/results/image-upload', ['as' => 'create-image-upload', 'uses' => 'AdminController@createImageUpload']);

    Route::post('/dashboard/apps/create/results/create-image', 'ImageController@createImage');

    Route::get('/dashboard/apps/create/results/pixlr-save', 'ImageController@pixlrSave');
    Route::get('/dashboard/apps/create/results/pixlr-load', 'ImageController@pixlrLoad');

    Route::get('/dashboard/apps/create/appset', 'AdminController@showCreateAppSet');
    Route::post('/dashboard/apps/create/appset', 'AdminController@saveCreateAppSet');
    Route::post('/dashboard/apps/create/publish', 'AdminController@publish');


    //Languages routes
    Route::get('/dashboard/languages', 'AdminController@showLanguages');
    Route::post('/dashboard/languages/savelang', 'AdminController@saveLanguages');

    //Widgets routes
    Route::get('/dashboard/widgets', 'AdminController@showWidgets');
    Route::post('/dashboard/widgets/save', 'AdminController@saveWidgets');

    //Pages routes
    Route::get('/dashboard/pages/add', 'AdminController@showAddPage');
    Route::post('/dashboard/pages/add/save', 'AdminController@saveNewPage');
    Route::get('/dashboard/pages/list', 'AdminController@showPagesList');
    Route::post('/dashboard/pages/delete', 'AdminController@deletePage');


   //Colors routes
    Route::get('/dashboard/changecolors', function () {
        return View::make('layouts.admin.colors.changecolor');
    });
    Route::get('/dashboard/changecolors/advanced', function () {
        return View::make('layouts.admin.colors.advancedcoloreditor');
    });
    Route::get('/dashboard/changecolors/simple', function () {
        return View::make('layouts.admin.colors.simplecoloreditor');
    });
    Route::post('/dashboard/changecolors', 'AdminController@storeColors');

    //Change Password routes
    Route::get('/dashboard/password', function () {
        return View::make('layouts.admin.password');
    });
    Route::post('/dashboard/password/save', 'AdminController@changePassword');

    //Export email list
    Route::get('/dashboard/export-emails', 'AdminController@exportEmails');

});

// Apps & Pages routes
Route::get('/', 'AppController@index');

Route::get('/sharecount', 'AppController@shareCount');

Route::get('/generated-count', 'AppController@generatedCount');

Route::get('/{appname}/master-image', 'ImageController@masterImage');

Route::get('/{appname}/media-image/{fbid?}-{gender?}-{fullname?}-{firstname?}-{lastname?}-{result?}-{arrayOfFriends?}.jpg', 'ImageController@mediaImageForFriends');

Route::get('/{appname}/media-image/{fbid?}-{gender?}-{fullname?}-{firstname?}-{lastname?}-{result?}.jpg', 'ImageController@mediaImage');

Route::get('/{appname}/media/{id?}-{result?}', 'AppController@media');

Route::get('/{appname}', 'AppController@show');

Route::post('/generate', 'AppController@generate');

Route::get('/pages/{url}', 'AppController@showPage');