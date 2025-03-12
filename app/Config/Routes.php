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

//gudang
$routes->get('gudang', 'GudangController::getGudang');
$routes->get('gudang/datacount', 'GudangController::index');
$routes->get('gudang/detail', 'GudangController::getgudangbyid');
$routes->post('gudang/save', 'GudangController::create');
$routes->post('gudang/update/(:any)', 'GudangController::update/$1');
$routes->get('gudang/delete', 'GudangController::deletedata');

//merk
$routes->get('merk', 'MerkController::getMerk');
$routes->get('merk/datacount', 'MerkController::index');
$routes->get('merk/detail', 'MerkController::getmerkbyid');
$routes->post('merk/save', 'MerkController::create');
$routes->post('merk/update/(:any)', 'MerkController::update/$1');
$routes->get('merk/delete', 'MerkController::deletedata');

//kategori
$routes->get('kategori', 'KategoriController::getkategori');
$routes->get('kategori/datacount', 'KategoriController::index');
$routes->get('kategori/detail', 'KategoriController::getkategoribyid');
$routes->post('kategori/save', 'KategoriController::create');
$routes->post('kategori/update/(:any)', 'KategoriController::update/$1');
$routes->get('kategori/delete', 'KategoriController::deletedata');
