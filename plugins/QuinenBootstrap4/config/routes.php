<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'QuinenBootstrap4',
    ['path' => '/quinen-bootstrap4'],
    function (RouteBuilder $routes) {
        $routes->connect('/', ['controller'=>"Index"]);
        $routes->fallbacks(DashedRoute::class);
    }
);
