<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('main');
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

$routes->get('/', 'Pageajax::index');
$routes->add('load', 'Home::loadPosts/$1');
//$routes->get('loadpageajax', 'Pageajax::loadContent/$1');
$routes->add('add', 'Home::add', ['filter' => 'auth']);
$routes->add('update', 'Home::update', ['filter' => 'auth']);
$routes->add('dellist', 'Home::dellist', ['filter' => 'auth']);
$routes->add('edit/(:num)', 'Home::edit/$1', ['filter' => 'auth']);
$routes->add('delete/(:num)', 'Home::delete/$1', ['filter' => 'auth']);
$routes->add('post/(:any)', 'Home::view/$1');

$routes->get('upimages', 'Uploads::index', ['filter' => 'auth']);
$routes->get('ptables', 'Home::main', ['filter' => 'auth']);

$routes->get('upload', 'Uploads::upimg', ['filter' => 'auth']);
$routes->post('upload', 'Uploads::upimg', ['filter' => 'auth']);


$routes->get('loadpageajax', 'Pageajax::loadContent/$1');
$routes->get('pagenotajax', 'Pagenotajax::index');
//$routes->post('pagenotajax', 'Pagenotajax::index');
//$routes->get('pagenotajax/(:num)', 'Pagenotajax::index/$1');

$routes->get('ptablesnjx', 'Ptablenotajax::index', ['filter' => 'auth']);
$routes->post('ptablesnjx', 'Ptablenotajax::index', ['filter' => 'auth']);

/*para login y sesiones*/
//$routes->add('login', 'Login::login');

$routes->get('pageajax', 'Pageajax::index/$1');

$routes->post('login', 'Users::login', ['filter' => 'noauth']);
$routes->get('login', 'Users::login', ['filter' => 'noauth']);
$routes->get('logout', 'Users::logout');
$routes->match(['get','post'],'register', 'Users::register', ['filter' => 'noauth']);
$routes->match(['get','post'],'profile', 'Users::profile', ['filter' => 'auth']);
$routes->get('dashboard', 'Dashboard::index',['filter' => 'auth']);

$routes->get('validate', 'Users::verify', ['filter' => 'noauth']);
$routes->post('validate', 'Users::verify', ['filter' => 'noauth']);


$routes->get('resetpassword', 'Users::resetpassword', ['filter' => 'noauth']);
$routes->post('resetpassword', 'Users::resetpassword', ['filter' => 'noauth']);
$routes->post('updatepassword', 'Users::updatepassword', ['filter' => 'noauth']);
$routes->get('updatepassword', 'Users::updatepassword', ['filter' => 'noauth']);

$routes->post('ajxregister', 'Users::ajxregister', ['filter' => 'noauth']);
$routes->post('ajxlogin', 'Users::ajxlogin', ['filter' => 'noauth']);
$routes->post('ajxupuser', 'Users::ajxupuser', ['filter' => 'auth']);

$routes->get('dragdrop', 'Drag::index', ['filter' => 'auth']);
$routes->post('upfiles', 'Drag::upfiles', ['filter' => 'auth']);

$routes->get('docs', 'Home::docs');

$routes->match(['get','post'],'scroll', 'Scroll::index', ['filter' => 'noauth']);

$routes->match(['get','post'],'loadscroll', 'Scroll::loadscroll', ['filter' => 'noauth']);
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
