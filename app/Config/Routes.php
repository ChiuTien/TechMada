<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');

//Employe 
$routes->get('/employe/dashboard', 'Home::dashboard');
$routes->get('/admin/employe', 'Home::adminEmploye');
