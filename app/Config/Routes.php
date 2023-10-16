<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserAPI::index');
$routes->post('/login', 'UserAPI::login');
$routes->post('/auth', 'UserAPI::readToken');
