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
$router->group(['prefix' => '/api/v1/'], function () use ($router) {
    $router->group(['prefix' => '/books'], function () use ($router) {
        $router->get('/', 'BookController@index');
        $router->post('/', 'BookController@store');
        $router->get('/{bookId:[0-9]+}', 'BookController@show');
        $router->patch('/{bookId:[0-9]+}', 'BookController@update');
        $router->delete('/{bookId:[0-9]+}', 'BookController@destroy');
    });

    $router->get('/search', 'BookController@searchBooks');

    $router->group(['prefix' => '/authors'], function () use ($router) {
        $router->get('/', 'AuthorController@index');
        $router->post('/', 'AuthorController@store');
        $router->get('/{authorId:[0-9]+}', 'AuthorController@show');
        $router->patch('/{authorId:[0-9]+}', 'AuthorController@update');
        $router->delete('/{authorId:[0-9]+}', 'AuthorController@destroy');
    });

    $router->group(['prefix' => '/genres'], function () use ($router) {
        $router->get('/', 'GenreController@index');
        $router->post('/', 'GenreController@store');
        $router->get('/{genreId:[0-9]+}', 'GenreController@show');
        $router->patch('/{genreId:[0-9]+}', 'GenreController@update');
        $router->delete('/{genreId:[0-9]+}', 'GenreController@destroy');
    });
});
