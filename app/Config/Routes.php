<?php

namespace Config;

use App\Controllers\coba;
use App\Controllers\comics;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'course::index');
$routes->get('/course', 'course::index');
$routes->get('/course/create', 'course::create');
$routes->get('/assign/(:num)', 'course::detail/$1');
$routes->get('/course/edit/(:num)', 'course::edit/$1');
$routes->delete('/course/(:num)', 'course::delete/$1');
$routes->get('/assignment/create', 'assignment::create');
$routes->get('/assignment/list/', 'assignment::list');
$routes->add('/assign/(:num)/(:num)', 'assignment::edit/$1/$2');
$routes->delete('/assign/(:num)', 'assignment::delete/$1');
$routes->get('/task/(:num)/(:num)', 'assignment::assign/$1/$2');
$routes->get('/Comics/create', 'Comics::create');
$routes->get('/Comics/edit/(:segment)', 'Comics::edit/$1');
$routes->delete('/Comics/(:num)', 'Comics::delete/$1');
$routes->get('/comics/(:any)', 'Comics::detail/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
