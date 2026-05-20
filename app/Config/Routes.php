<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'Home::login');

//Employe 
$routes->get('/employe/dashboard', 'Home::dashboard');
$routes->get('/employe/create', 'Employe::getAllObjectifs');

// Administration CRUD
$routes->get('/admin/employe', 'Admin::employes');
$routes->post('/admin/employe/save', 'Admin::saveEmploye');
$routes->post('/admin/employe/delete/(:num)', 'Admin::deleteEmploye/$1');

$routes->post('/admin/departement/save', 'Admin::saveDepartement');
$routes->post('/admin/departement/delete/(:num)', 'Admin::deleteDepartement/$1');

$routes->post('/admin/type-conge/save', 'Admin::saveTypeConge');
$routes->post('/admin/type-conge/delete/(:num)', 'Admin::deleteTypeConge/$1');
