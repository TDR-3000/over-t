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
use Illuminate\Support\Facades\Artisan;
// REDIRECT API //
$router->get('/', function () {
	return redirect('api/v1');
});
$router->get('/api', function () {
	return redirect('api/v1');
});
$router->get('/api/v1', 'HomeController');
// ROUTES //
$router->group(['middleware' => 'api', 'prefix' => 'api/v1'], function () use ($router) {
	// LOGIN //
	$router->post('/login', 'Login\AuthController');
	// STATES //
	$router->group(['middleware' => 'auth', 'prefix' => 'states'], function () use ($router) {
		$router->get('/', 'States\IndexController');
		$router->get('/{id}', 'States\ShowController');
	});
	// USERS //
	$router->group(['middleware' => 'auth', 'prefix' => 'users'], function () use ($router) {
		$router->get('/', 'Users\IndexController');
		$router->get('/{id}', 'Users\ShowController');
		$router->put('/{id}', 'Users\UpdateController');
		$router->delete('/{id}', 'Users\DeleteController');
	});
	$router->post('/users', 'Users\StoreController');
	// CATEGORIES TASKS //
	$router->group(['middleware' => 'auth', 'prefix' => 'categories-tasks'], function () use ($router) {
		$router->get('/', 'CategoriesTasks\IndexController');
		$router->post('/', 'CategoriesTasks\StoreController');
		$router->get('/{id}', 'CategoriesTasks\ShowController');
		$router->put('/{id}', 'CategoriesTasks\UpdateController');
		$router->delete('/{id}', 'CategoriesTasks\DeleteController');
	});
	// TASKS //
	$router->group(['middleware' => 'auth', 'prefix' => 'tasks'], function () use ($router) {
		$router->get('/', 'Tasks\IndexController');
		$router->post('/', 'Tasks\StoreController');
		$router->get('/{id}', 'Tasks\ShowController');
		$router->put('/{id}', 'Tasks\UpdateController');
		$router->delete('/{id}', 'Tasks\DeleteController');
	});
});

