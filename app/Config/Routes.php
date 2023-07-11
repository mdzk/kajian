<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['as' => 'hasil-add', 'filter' => 'auth']);

// Authentication Section
// --- Login Section
$routes->get('/login', 'Auth\LoginController::index', ['as' => 'login']);
$routes->post('/login/auth', 'Auth\LoginController::auth', ['as' => 'auth']);
$routes->get('/logout', 'Auth\LoginController::logout', ['as' => 'logout', 'filter' => 'auth']);
// --- Register Section
$routes->get('/register', 'Auth\RegisterController::index', ['as' => 'register']);
$routes->post('/register/store', 'Auth\RegisterController::store', ['as' => 'register-store']);
// --- Forgot Password Section
$routes->get('/forgot', 'Auth\ForgotPasswordController::index', ['as' => 'forgot']);
$routes->post('/forgot/password', 'Auth\ForgotPasswordController::forgotPassword', ['as' => 'forgot-password']);
$routes->get('/reset-password/(:segment)', 'Auth\ForgotPasswordController::resetPassword/$1', ['as' => 'reset-password']);
$routes->post('/update-password', 'Auth\ForgotPasswordController::updatePassword', ['as' => 'update-password']);

// Kajian Section
// --- Dahulu
$routes->get('/kajian/dahulu', 'Kajian\PendahuluanController::index', ['as' => 'dahulu', 'filter' => 'auth']);
$routes->get('/kajian/dahulu/add', 'Kajian\PendahuluanController::add', ['as' => 'dahulu-add', 'filter' => 'auth']);
$routes->post('/kajian/dahulu/store', 'Kajian\PendahuluanController::store', ['as' => 'dahulu-store', 'filter' => 'auth']);
$routes->post('/kajian/dahulu/delete', 'Kajian\PendahuluanController::delete', ['as' => 'dahulu-delete', 'filter' => 'auth']);
$routes->get('/kajian/dahulu/edit/(:num)', 'Kajian\PendahuluanController::edit/$1', ['as' => 'dahulu-edit', 'filter' => 'auth']);
$routes->post('/kajian/dahulu/update', 'Kajian\PendahuluanController::update', ['as' => 'dahulu-update', 'filter' => 'auth']);
$routes->get('/kajian/dahulu/show/(:num)', 'Kajian\PendahuluanController::show/$1', ['as' => 'dahulu-show', 'filter' => 'auth']);
// --- Dahulu
$routes->get('/kajian/antara', 'Kajian\AntaraController::index', ['as' => 'antara', 'filter' => 'auth']);
$routes->get('/kajian/antara/add', 'Kajian\AntaraController::add', ['as' => 'antara-add', 'filter' => 'auth']);
$routes->post('/kajian/antara/store', 'Kajian\AntaraController::store', ['as' => 'antara-store', 'filter' => 'auth']);
$routes->post('/kajian/antara/delete', 'Kajian\AntaraController::delete', ['as' => 'antara-delete', 'filter' => 'auth']);
$routes->get('/kajian/antara/edit/(:num)', 'Kajian\AntaraController::edit/$1', ['as' => 'antara-edit', 'filter' => 'auth']);
$routes->post('/kajian/antara/update', 'Kajian\AntaraController::update', ['as' => 'antara-update', 'filter' => 'auth']);
$routes->get('/kajian/antara/show/(:num)', 'Kajian\AntaraController::show/$1', ['as' => 'antara-show', 'filter' => 'auth']);
// --- Dahulu
$routes->get('/kajian/akhir', 'Kajian\AkhirController::index', ['as' => 'akhir', 'filter' => 'auth']);
$routes->get('/kajian/akhir/add', 'Kajian\AkhirController::add', ['as' => 'akhir-add', 'filter' => 'auth']);
$routes->post('/kajian/akhir/store', 'Kajian\AkhirController::store', ['as' => 'akhir-store', 'filter' => 'auth']);
$routes->post('/kajian/akhir/delete', 'Kajian\AkhirController::delete', ['as' => 'akhir-delete', 'filter' => 'auth']);
$routes->get('/kajian/akhir/edit/(:num)', 'Kajian\AkhirController::edit/$1', ['as' => 'akhir-edit', 'filter' => 'auth']);
$routes->post('/kajian/akhir/update', 'Kajian\AkhirController::update', ['as' => 'akhir-update', 'filter' => 'auth']);
$routes->get('/kajian/akhir/show/(:num)', 'Kajian\AkhirController::show/$1', ['as' => 'akhir-show', 'filter' => 'auth']);

// Usulan Section
$routes->get('/redirect/(:any)', 'UsulanController::redirect/$1', ['as' => 'redirect', 'filter' => 'auth']);
$routes->get('/usulan', 'UsulanController::index', ['as' => 'usulan', 'filter' => 'auth']);
$routes->post('/usulan/store', 'UsulanController::store', ['as' => 'usulan-store', 'filter' => 'auth']);
$routes->post('/usulan/verification', 'UsulanController::verification', ['as' => 'usulan-verification', 'filter' => 'auth']);
$routes->post('/usulan/process', 'UsulanController::process', ['as' => 'usulan-process', 'filter' => 'auth']);
$routes->post('/usulan/decline', 'UsulanController::decline', ['as' => 'usulan-decline', 'filter' => 'auth']);
$routes->post('/usulan/revision', 'UsulanController::revision', ['as' => 'usulan-revision', 'filter' => 'auth']);
$routes->get('/usulan/edit/(:num)', 'UsulanController::edit/$1', ['as' => 'usulan-edit', 'filter' => 'auth']);

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
