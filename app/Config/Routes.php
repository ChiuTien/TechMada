<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Employe 
$routes->get('/employe/dashboard', 'Home::dashboard');
