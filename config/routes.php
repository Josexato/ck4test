<?php

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);

$routes->scope('/', function (RouteBuilder $builder) {
    $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));
    $builder->applyMiddleware('csrf');
    $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $builder->scope('/articles', function (RouteBuilder $builder) {
        $builder->connect('/tagged/*', ['controller' => 'Articles', 'action' => 'tags']);
    });
    $builder->fallbacks();
});
