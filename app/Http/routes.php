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

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('videos/{id}', 'App\Api\Controllers\VideoController@show');
	$api->get('videos/{from?}/{to?}/{realisator?}', 'App\Api\Controllers\VideoController@index');
});
