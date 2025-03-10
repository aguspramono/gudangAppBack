<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('supplier', 'SupplierController::index');
$routes->get('supplierid', 'SupplierController::getsupplierbyid');
$routes->get('filtersupplier', 'SupplierController::getSupplier');
$routes->get('maxnoacc', 'SupplierController::maxnoacc');
$routes->post('savesupplier', 'SupplierController::create');
$routes->post('supplier/update/(:any)', 'SupplierController::update/$1');
$routes->get('supplier/delete', 'SupplierController::deletedata');
