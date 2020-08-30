<?php

namespace App\Http\Routes;

use Doctrine\Common\Annotations\AnnotationReader;
use ReflectionClass;
use ReflectionMethod;

/**
 * Class collect all routes in array
 */
class RouteCollector
{
    /**
     * Return array of routes that declared in controllers in $controllerPath
     *
     * @param string $controllersPath
     * @param string $namespace
     *
     * @return array
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \ReflectionException
     */
    public function collect(string $controllersPath, string $namespace)
    {
        // find all classes in $controllersPath
        $classes = [];
        foreach (glob($controllersPath . '/*Controller.php') as $file) {
            $classes[] = basename($file, '.php');
        }

        // array of Route objects that declare routes
        $routes = [];
        // create reader
        $reader = new AnnotationReader();

        foreach ($classes as $class) {
            $refClass = new ReflectionClass($namespace . $class);

            // get all public methods from class
            $refMethods = $refClass->getMethods(ReflectionMethod::IS_PUBLIC);

            foreach ($refMethods as $method) {
                // get annotation Route
                $annotation = $reader->getMethodAnnotation($method, Route::class);
                if ($annotation) {
                    $routes[] = $annotation;
                }
            }
        }

        return $routes;
    }
}
