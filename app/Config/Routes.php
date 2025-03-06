<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('pegawai', 'PegawaiController::index');
$routes->get('pegawai/detail', 'PegawaiController::detail');
$routes->get('pegawai/absensi', 'PegawaiController::absensi');
$routes->get('login', 'LoginController::index');
$routes->get('login/detail', 'LoginController::detail');
$routes->put('loginuser/update/(:num)', 'LoginuserController::update/$1');
$routes->put('loginuser/uppass/(:num)', 'LoginuserController::updatePassword/$1');
$routes->get('atasan', 'LoginuserController::index');
$routes->post('token/create', 'TokenController::create');
$routes->delete('token/delete/(:num)', 'TokenController::delete/$1');
$routes->delete('token/deletebytoken/(:any)', 'TokenController::deletebytoken/$1');
$routes->post('tambahcuti', 'CutiController::create');
$routes->get('notifcutime', 'CutiController::notifcutime');
$routes->get('notifcutibos', 'CutiController::notifcutibos');
$routes->get('cekcutiuser', 'CutiController::cekcutiuser');
$routes->get('riwayatcuti', 'CutiController::riwayatcuti');
$routes->delete('batalcuti/(:any)', 'CutiController::delete/$1');
$routes->get('getcutiwhere', 'CutiController::getCutiWhere');
$routes->put('updatecutidisetujui/(:num)/(:any)', 'CutiController::update/$1/$1');




$routes->get('lastupdate', 'LastupdateController::index');
//$routes->get('cutialluser', 'CutiController::cutialluser');
