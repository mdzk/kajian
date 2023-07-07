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
$routes->get('/', 'Home::index', ['as' => 'hasil-add', 'filter' => 'auth:admin,user']);

// Authentication Section
// --- Login Section
$routes->get('/login', 'Auth\LoginController::index', ['as' => 'login']);
$routes->post('/login/auth', 'Auth\LoginController::auth', ['as' => 'auth']);
$routes->get('/logout', 'Auth\LoginController::logout', ['as' => 'logout']);
// --- Register Section
$routes->get('/register', 'Auth\RegisterController::index', ['as' => 'register']);
$routes->post('/register/store', 'Auth\RegisterController::store', ['as' => 'register-store']);
// --- Forgot Password Section
$routes->get('/forgot', 'Auth\ForgotPasswordController::index', ['as' => 'forgot']);
$routes->post('/forgot/password', 'Auth\ForgotPasswordController::forgotPassword', ['as' => 'forgot-password']);
$routes->get('/reset-password/(:segment)', 'Auth\ForgotPasswordController::resetPassword/$1', ['as' => 'reset-password']);
$routes->post('/update-password', 'Auth\ForgotPasswordController::updatePassword', ['as' => 'update-password']);
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
