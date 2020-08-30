<?php

namespace App\Http\Routes;

/**
 * Class keep data of route declared in controller`s method
 * For declare route need add phpDoc for method. For example:
 *
 * \@App\Http\Routes\Route(
 *   method = {"GET"},
 *   uri = "/book",
 *   action = "BookController@index",
 * )
 * This fields used in FastRoute library, $router->addRoute().
 *
 * @Annotation
 * @Target({"CLASS","METHOD"}) - annotation can apply only for class or method
 */
class Route
{
    /** @var array метод */
    public $method;
    /** @var string uri маршрута */
    public $uri;
    /** @var mixed обработчик - метод класса */
    public $action;
}
