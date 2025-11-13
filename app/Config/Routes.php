<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Authentikasi\Login::index');

$routes->group('auth', ['namespace' => 'App\Controllers\Authentikasi'], function ($routes){
    $routes->get('login', 'Login::index');
    $routes->post('login/authenticate', 'Login::authenticate');
    $routes->get('signup', 'Signup::index');
    $routes->post('signup', 'Signup::register'); 
    $routes->get('logout', 'Login::logout');
});

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('home', 'Home::index');
    $routes->get('listMobil', 'ListMobil::index');
    $routes->get('listMotor', 'ListMotor::index');
    $routes->get('deskripsi/(:num)', 'Deskripsi::index/$1');
    $routes->get('formTransaksi/(:num)', 'FormTransaksi::index/$1');
    $routes->post('formTransaksi/(:num)', 'FormTransaksi::formTransaksi/$1');
    $routes->get('history', 'History::index');
    $routes->get('contact', 'Contact::index');
    $routes->get('editHistory/(:num)', 'EditHistory::edit/$1');
    $routes->post('editHistory/update/(:num)', 'EditHistory::update/$1');
    $routes->post('history/delete/(:num)', 'EditHistory::delete/$1');
});

$routes->group('users', ['namespace' => 'App\Controllers\Users'], function ($routes) {
    $routes->get('home', 'Home::index');
    $routes->get('listMobil', 'ListMobil::index');
    $routes->get('listMotor', 'ListMotor::index');
    $routes->get('deskripsi/(:num)', 'Deskripsi::index/$1');
    $routes->get('formTransaksi/(:num)', 'FormTransaksi::index/$1');
    $routes->post('formTransaksi/(:num)', 'FormTransaksi::formTransaksi/$1');
    $routes->get('contact', 'Contact::index');
});
