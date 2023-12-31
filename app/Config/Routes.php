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
$routes->get('/', 'Home::index', ['as' => 'dashboard', 'filter' => 'auth']);
$routes->get('/json/kajian', 'Home::kajian', ['as' => 'json-kajian', 'filter' => 'auth']);
$routes->post('/pdf/rekapan/semua', 'PdfController::rekapanSemua', ['as' => 'pdf-rekapan', 'filter' => 'auth:admin,pimpinan']);
$routes->post('/pdf/rekapan/filter', 'PdfController::rekapanFilter', ['as' => 'pdf-rekapan-filter', 'filter' => 'auth:admin,pimpinan']);

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
$routes->get('/kajian', 'KajianController::index', ['as' => 'kajian', 'filter' => 'auth']);
$routes->get('/kajian/add', 'KajianController::add', ['as' => 'kajian-add', 'filter' => 'auth:admin']);
$routes->post('/kajian/store', 'KajianController::store', ['as' => 'kajian-store', 'filter' => 'auth:admin']);
$routes->post('/kajian/delete', 'KajianController::delete', ['as' => 'kajian-delete', 'filter' => 'auth:admin']);
$routes->get('/kajian/edit/(:num)', 'KajianController::edit/$1', ['as' => 'kajian-edit', 'filter' => 'auth:admin']);
$routes->post('/kajian/update', 'KajianController::update', ['as' => 'kajian-update', 'filter' => 'auth:admin']);
$routes->get('/kajian/show/(:num)', 'KajianController::show/$1', ['as' => 'kajian-show', 'filter' => 'auth']);
// // --- Dahulu
// $routes->get('/kajian/dahulu', 'Kajian\PendahuluanController::index', ['as' => 'dahulu', 'filter' => 'auth']);
// $routes->get('/kajian/dahulu/add', 'Kajian\PendahuluanController::add', ['as' => 'dahulu-add', 'filter' => 'auth:admin']);
// $routes->post('/kajian/dahulu/store', 'Kajian\PendahuluanController::store', ['as' => 'dahulu-store', 'filter' => 'auth:admin']);
// $routes->post('/kajian/dahulu/delete', 'Kajian\PendahuluanController::delete', ['as' => 'dahulu-delete', 'filter' => 'auth:admin']);
// $routes->get('/kajian/dahulu/edit/(:num)', 'Kajian\PendahuluanController::edit/$1', ['as' => 'dahulu-edit', 'filter' => 'auth:admin']);
// $routes->post('/kajian/dahulu/update', 'Kajian\PendahuluanController::update', ['as' => 'dahulu-update', 'filter' => 'auth:admin']);
// $routes->get('/kajian/dahulu/show/(:num)', 'Kajian\PendahuluanController::show/$1', ['as' => 'dahulu-show', 'filter' => 'auth']);
// // --- Dahulu
// $routes->get('/kajian/antara', 'Kajian\AntaraController::index', ['as' => 'antara', 'filter' => 'auth']);
// $routes->get('/kajian/antara/add', 'Kajian\AntaraController::add', ['as' => 'antara-add', 'filter' => 'auth:admin']);
// $routes->post('/kajian/antara/store', 'Kajian\AntaraController::store', ['as' => 'antara-store', 'filter' => 'auth:admin']);
// $routes->post('/kajian/antara/delete', 'Kajian\AntaraController::delete', ['as' => 'antara-delete', 'filter' => 'auth:admin']);
// $routes->get('/kajian/antara/edit/(:num)', 'Kajian\AntaraController::edit/$1', ['as' => 'antara-edit', 'filter' => 'auth:admin']);
// $routes->post('/kajian/antara/update', 'Kajian\AntaraController::update', ['as' => 'antara-update', 'filter' => 'auth:admin']);
// $routes->get('/kajian/antara/show/(:num)', 'Kajian\AntaraController::show/$1', ['as' => 'antara-show', 'filter' => 'auth']);
// // --- Dahulu
// $routes->get('/kajian/akhir', 'Kajian\AkhirController::index', ['as' => 'akhir', 'filter' => 'auth']);
// $routes->get('/kajian/akhir/add', 'Kajian\AkhirController::add', ['as' => 'akhir-add', 'filter' => 'auth:admin']);
// $routes->post('/kajian/akhir/store', 'Kajian\AkhirController::store', ['as' => 'akhir-store', 'filter' => 'auth:admin']);
// $routes->post('/kajian/akhir/delete', 'Kajian\AkhirController::delete', ['as' => 'akhir-delete', 'filter' => 'auth:admin']);
// $routes->get('/kajian/akhir/edit/(:num)', 'Kajian\AkhirController::edit/$1', ['as' => 'akhir-edit', 'filter' => 'auth:admin']);
// $routes->post('/kajian/akhir/update', 'Kajian\AkhirController::update', ['as' => 'akhir-update', 'filter' => 'auth:admin']);
// $routes->get('/kajian/akhir/show/(:num)', 'Kajian\AkhirController::show/$1', ['as' => 'akhir-show', 'filter' => 'auth']);

// Usulan Section
$routes->get('/redirect/(:any)', 'UsulanController::redirect/$1', ['as' => 'redirect', 'filter' => 'auth']);
$routes->get('/usulan', 'UsulanController::index', ['as' => 'usulan', 'filter' => 'auth']);
$routes->post('/usulan/store', 'UsulanController::store', ['as' => 'usulan-store', 'filter' => 'auth:user']);
$routes->get('/usulan/edit/(:num)', 'UsulanController::edit/$1', ['as' => 'usulan-edit', 'filter' => 'auth:user']);
$routes->get('/usulan/show/(:num)', 'UsulanController::show/$1', ['as' => 'usulan-show', 'filter' => 'auth']);
$routes->post('/usulan/update', 'UsulanController::update', ['as' => 'usulan-update', 'filter' => 'auth:user']);
$routes->post('/usulan/delete', 'UsulanController::delete', ['as' => 'usulan-delete', 'filter' => 'auth:user']);

$routes->post('/usulan/process', 'UsulanController::process', ['as' => 'usulan-process', 'filter' => 'auth:admin']);
$routes->post('/usulan/verification', 'UsulanController::verification', ['as' => 'usulan-verification', 'filter' => 'auth:pimpinan']);
$routes->post('/usulan/decline', 'UsulanController::decline', ['as' => 'usulan-decline', 'filter' => 'auth:pimpinan']);
$routes->post('/usulan/revision', 'UsulanController::revision', ['as' => 'usulan-revision', 'filter' => 'auth:pimpinan']);
$routes->post('/usulan/revisionadmin', 'UsulanController::revisionAdmin', ['as' => 'usulan-revision-admin', 'filter' => 'auth:admin']);

// Rekapan Section
$routes->get('/rekapan', 'RekapanController::index', ['as' => 'rekapan', 'filter' => 'auth:admin']);
$routes->get('/rekapan/show/(:num)', 'RekapanController::show/$1', ['as' => 'rekapan-show', 'filter' => 'auth:admin']);

// Users Section
$routes->get('/users', 'UsersController::index', ['as' => 'users', 'filter' => 'auth:admin']);
$routes->post('/users/delete', 'UsersController::delete', ['as' => 'users-delete', 'filter' => 'auth:admin']);
$routes->post('/users/update', 'UsersController::update', ['as' => 'users-update', 'filter' => 'auth:admin']);
$routes->post('/users/store', 'UsersController::store', ['as' => 'users-store', 'filter' => 'auth:admin']);

// Verification Section
$routes->get('/verification', 'VerificationController::index', ['as' => 'verification', 'filter' => 'auth:admin']);
$routes->post('/verification/update', 'VerificationController::update', ['as' => 'verification-update', 'filter' => 'auth:admin']);

// Setting Section
$routes->get('/setting', 'SettingController::index', ['as' => 'setting', 'filter' => 'auth']);
$routes->post('/setting/update', 'SettingController::update', ['as' => 'setting-update', 'filter' => 'auth']);
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
