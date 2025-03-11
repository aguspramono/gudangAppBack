<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//supplier
$routes->get('supplier', 'SupplierController::index');
$routes->get('supplierid', 'SupplierController::getsupplierbyid');
$routes->get('filtersupplier', 'SupplierController::getSupplier');
$routes->get('maxnoacc', 'SupplierController::maxnoacc');
$routes->post('savesupplier', 'SupplierController::create');
$routes->post('supplier/update/(:any)', 'SupplierController::update/$1');
$routes->get('supplier/delete', 'SupplierController::deletedata');

//departemen
$routes->get('departemen', 'DepartemenController::getDepartemen');
$routes->get('departemen/datacount', 'DepartemenController::index');
$routes->get('departemen/detail', 'DepartemenController::getdepartemenbyid');
$routes->post('departemen/save', 'DepartemenController::create');
$routes->post('departemen/update/(:any)', 'DepartemenController::update/$1');
$routes->get('departemen/delete', 'DepartemenController::deletedata');

//lokasi
$routes->get('lokasi', 'LokasiController::getLokasi');
$routes->get('lokasi/datacount', 'LokasiController::index');
$routes->get('lokasi/detail', 'LokasiController::getlokasibyid');
$routes->post('lokasi/save', 'LokasiController::create');
$routes->post('lokasi/update/(:any)', 'LokasiController::update/$1');
$routes->get('lokasi/delete', 'LokasiController::deletedata');

//satuan
$routes->get('satuan', 'SatuanController::getSatuan');
$routes->get('satuan/datacount', 'SatuanController::index');
$routes->get('satuan/detail', 'SatuanController::getsatuanbyid');
$routes->post('satuan/save', 'SatuanController::create');
$routes->post('satuan/update/(:any)', 'SatuanController::update/$1');
$routes->get('satuan/delete', 'SatuanController::deletedata');
