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

/** @var \Laravel\Lumen\Routing\Router $router */
// Create new collector
$collector = new \App\Http\Routes\RouteCollector();

// Get routes from classes
/** @var \App\Http\Routes\Route[] $routes */
$routes = $collector->collect(__DIR__ . '/../app/Http/Controllers/API/', 'App\Http\Controllers\API\\');

// Add routes
foreach ($routes as $route) {
    $router->addRoute($route->method, '/api/v1' . $route->uri, $route->action);
}
