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
$routes->get('satuan/all', 'SatuanController::allsatuan');
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
$routes->get('merk/all', 'MerkController::getalldatamerk');
$routes->get('merk/datacount', 'MerkController::index');
$routes->get('merk/detail', 'MerkController::getmerkbyid');
$routes->post('merk/save', 'MerkController::create');
$routes->post('merk/update/(:any)', 'MerkController::update/$1');
$routes->get('merk/delete', 'MerkController::deletedata');

//kategori
$routes->get('kategori', 'KategoriController::getkategori');
$routes->get('kategori/all', 'KategoriController::allkategori');
$routes->get('kategori/datacount', 'KategoriController::index');
$routes->get('kategori/detail', 'KategoriController::getkategoribyid');
$routes->post('kategori/save', 'KategoriController::create');
$routes->post('kategori/update/(:any)', 'KategoriController::update/$1');
$routes->get('kategori/delete', 'KategoriController::deletedata');

//product
$routes->get('product', 'ProductController::getProduct');
$routes->get('product/datacount', 'ProductController::index');
$routes->get('product/detail', 'ProductController::getProductbyid');
$routes->post('product/save', 'ProductController::create');
$routes->post('product/update/(:any)', 'ProductController::update/$1');
$routes->get('product/delete', 'ProductController::deletedata');
$routes->get('stockdistribusi', 'ProductController::stokdistribusi');

//productdetail
$routes->get('productdetail', 'ProductdetailController::getProductDetail');
$routes->get('productdetail/datacount', 'ProductdetailController::index');
$routes->get('productdetail/detail', 'ProductdetailController::getProductDetailbyid');
$routes->post('productdetail/save', 'ProductdetailController::create');
$routes->post('productdetail/update/(:any)', 'ProductdetailController::update/$1');
$routes->get('productdetail/delete', 'ProductdetailController::deletedata');

//StockAdj
$routes->get('stockadj', 'StockAdjController::getStockAdj');
$routes->get('stockadj/datacount', 'StockAdjController::index');
$routes->get('stockadj/detail', 'StockAdjController::getStockAdjbyid');
$routes->post('stockadj/save', 'StockAdjController::create');
$routes->post('stockadj/update/(:any)', 'StockAdjController::update/$1');
$routes->get('stockadj/delete', 'StockAdjController::deletedata');

//StockAdjdetail
$routes->get('stockadjdetail', 'StockAdjDetailController::getStockAdjDetail');
$routes->get('stockadjdetail/datacount', 'StockAdjdetailController::index');
$routes->get('stockadjdetail/detail', 'StockAdjdetailController::getStockAdjDetailbyid');
$routes->post('stockadjdetail/save', 'StockAdjdetailController::create');
$routes->post('stockadjdetail/update/(:any)', 'StockAdjdetailController::update/$1');
$routes->get('stockadjdetail/delete', 'StockAdjdetailController::deletedata');


//stockClosing
$routes->get('stockclosing', 'StockClosingController::getStockClosing');
$routes->get('stockclosing/datacount', 'StockClosingController::index');
$routes->get('stockclosing/detail', 'StockClosingController::getStockClosingbyid');
$routes->post('stockclosing/save', 'StockClosingController::create');
$routes->post('stockclosing/update/(:any)', 'StockClosingController::update/$1');
$routes->get('stockclosing/delete', 'StockClosingController::deletedata');

//stockClosingDetail
$routes->get('stockclosingdetail', 'StockClosingDetailController::getStockClosingDetail');
$routes->get('stockclosingdetail/datacount', 'StockClosingDetailController::index');
$routes->get('stockclosingdetail/detail', 'StockClosingDetailController::getStockClosingDetailbyid');
$routes->post('stockclosingdetail/save', 'StockClosingDetailController::create');
$routes->post('stockclosingdetail/update/(:any)', 'StockClosingDetailController::update/$1');
$routes->get('stockclosingdetail/delete', 'StockClosingDetailController::deletedata');
