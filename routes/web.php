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

// REDIRECT API //
$router->get('/', function () {
	return redirect('api/v1');
});
$router->get('/api', function () {
	return redirect('api/v1');
});

// ROUTES //
$router->group(['prefix' => 'api/v1'], function () use ($router) {
	$router->get('/', function () {
		echo 'hola mundo';
	});
	// STATES //
	$router->group(['prefix' => 'states'], function () use ($router) {
		$router->get('/', 'States\IndexController');
	});
	// USERS //
	$router->group(['prefix' => 'users'], function () use ($router) {
		$router->get('/', 'Users\IndexController');
	});
});
