<?php namespace Config;

/**
 * --------------------------------------------------------------------
 * URI Routing
 * --------------------------------------------------------------------
 * This file lets you re-map URI requests to specific controller functions.
 *
 * Typically there is a one-to-one relationship between a URL string
 * and its corresponding controller class/method. The segments in a
 * URL normally follow this pattern:
 *
 *    example.com/class/method/id
 *
 * In some instances, however, you may want to remap this relationship
 * so that a different class/function is called than the one
 * corresponding to the URL.
 */

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 * The RouteCollection object allows you to modify the way that the
 * Router works, by acting as a holder for it's configuration settings.
 * The following methods can be called on the object to modify
 * the default operations.
 *
 *    $routes->defaultNamespace()
 *
 * Modifies the namespace that is added to a controller if it doesn't
 * already have one. By default this is the global namespace (\).
 *
 *    $routes->defaultController()
 *
 * Changes the name of the class used as a controller when the route
 * points to a folder instead of a class.
 *
 *    $routes->defaultMethod()
 *
 * Assigns the method inside the controller that is ran when the
 * Router is unable to determine the appropriate method to run.
 *
 *    $routes->setAutoRoute()
 *
 * Determines whether the Router will attempt to match URIs to
 * Controllers when no specific route has been defined. If false,
 * only routes that have been defined here will be available.
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');

$routes->match(['get','post'], 'users/login', 'Users::login');
$routes->match(['get','post'], 'users/signup', 'Users::signup');
$routes->match(['get','post'], 'users/profile', 'Users::profile');
$routes->match(['get','post'], 'books/create', 'Books::create');
$routes->match(['get','post'], 'carts/payment', 'Carts::payment');

$routes->match(['get','post'], 'books/edit/(:any)', 'Books::edit/$1');
$routes->match(['get','post'], 'carts/create/(:any)', 'Carts::create/$1');
$routes->match(['get','post'], 'carts/remove/(:any)', 'Carts::remove/$1');
$routes->match(['get','post'], 'carts/payment/(:any)', 'Carts::payment/$1');

$routes->get('/users/forgot-password', 'Users::forgot_password');
$routes->get('/users/logout', 'Users::logout');
$routes->get('/books/delete/(:any)', 'Books::delete/$1');
$routes->get('/books/(:any)', 'Books::index/$1');
$routes->get('/carts/(:any)', 'Carts::index/$1');
$routes->get('/orders/approve/(:any)', 'Orders::approve/$1');
$routes->get('/orders/(:any)', 'Orders::index/$1');
$routes->post('/payment/upload_proof/(:any)', 'Carts::upload_proof/$1');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
