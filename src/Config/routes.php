<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add('hello', new Route('/hello/{name}', array(
        '_controller' => 'App\\Controller\\DefaultController::indexAction',
    )
));

return $routes;
