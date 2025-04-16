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
$routes->get('departemen/all', 'DepartemenController::getAllDepartemen');
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
$routes->get('gudang/alldata', 'GudangController::alldatagudang');
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


//reopenpriode
$routes->get('periode', 'ReopenPeriodeController::cekperiode');
$routes->post('periode/update/(:any)', 'ReopenPeriodeController::updateperiode/$1');

//Periode
$routes->get('periode/data', 'PeriodeController::index');

//Aktiday
$routes->get('aktifday', 'AktifdayController::index');
$routes->post('aktifday/update/(:any)', 'AktifdayController::update/$1');



//productdetail
$routes->get('productdetail', 'ProductdetailController::getProductDetail');
$routes->get('productdetail/datacount', 'ProductdetailController::index');
$routes->get('productdetail/detail', 'ProductdetailController::getProductDetailbyid');
$routes->post('productdetail/save/(:any)', 'ProductdetailController::createProductDetail/$1');
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

//stockClosingPesanan
$routes->get('stockclosingpesanan', 'StockClosingPesananController::getStockClosingPesanan');
$routes->get('stockclosingpesanan/datacount', 'StockClosingPesananController::index');
$routes->get('stockclosingpesanan/detail', 'StockClosingPesananController::getStockClosingPesananbyid');
$routes->post('stockclosingpesanan/save', 'StockClosingPesananController::create');
$routes->post('stockclosingpesanan/update/(:any)', 'StockClosingPesananController::update/$1');
$routes->get('stockclosingpesanan/delete', 'StockClosingPesananController::deletedata');

//stockClosingPesananDetail
$routes->get('stockclosingpesanandetail', 'StockClosingPesananDetailController::getStockClosingPesananDetail');
$routes->get('stockclosingpesanandetail/datacount', 'StockClosingPesananDetailController::index');
$routes->get('stockclosingpesanandetail/detail', 'StockClosingPesananDetailController::getStockClosingPesananDetailbyid');
$routes->post('stockclosingpesanandetail/save', 'StockClosingPesananDetailController::create');
$routes->post('stockclosingpesanandetail/update/(:any)', 'StockClosingPesananDetailController::update/$1');
$routes->get('stockclosingpesanandetail/delete', 'StockClosingPesananDetailController::deletedata');

//stockin
$routes->get('stockin', 'StockInController::getStockIn');
$routes->get('stockin/datacount', 'StockInController::index');
$routes->get('stockin/detail', 'StockInController::getStockInbyid');
$routes->post('stockin/save', 'StockInController::create');
$routes->post('stockin/update/(:any)', 'StockInController::update/$1');
$routes->get('stockin/delete', 'StockInController::deletedata');

//stockindetail
$routes->get('stockindetail', 'StockInDetailController::getStockInDetail');
$routes->get('stockindetail/datacount', 'StockInDetailController::index');
$routes->get('stockindetail/detail', 'StockInDetailController::getStockInDetailbyid');
$routes->post('stockindetail/save', 'StockInDetailController::create');
$routes->post('stockindetail/update/(:any)', 'StockInDetailController::update/$1');
$routes->get('stockindetail/delete', 'StockInDetailController::deletedata');

//stockLunasHutang
$routes->get('stocklunashutang', 'StockLunasHutangController::getStockLunasHutang');
$routes->get('stocklunashutang/all', 'StockLunasHutangController::allStockLunasHutang');
$routes->get('stocklunashutang/datacount', 'StockLunasHutangController::index');
$routes->get('stocklunashutang/detail', 'StockLunasHutangController::getStockLunasHutangbyid');
$routes->post('stocklunashutang/save', 'StockLunasHutangController::create');
$routes->post('stocklunashutang/update/(:any)', 'StockLunasHutangController::update/$1');
$routes->get('stocklunashutang/delete', 'StockLunasHutangController::deletedata');

//stockLunasHutangDetail
$routes->get('stocklunashutangdetail', 'StockLunasHutangDetailController::getStockLunasHutangDetail');
$routes->get('stocklunashutangdetail/all', 'StockLunasHutangDetailController::allStockLunasHutangDetail');
$routes->get('stocklunashutangdetail/datacount', 'StockLunasHutangDetailController::index');
$routes->get('stocklunashutangdetail/detail', 'StockLunasHutangDetailController::getStockLunasHutangDetailbyid');
$routes->post('stocklunashutangdetail/save', 'StockLunasHutangDetailController::create');
$routes->post('stocklunashutangdetail/update/(:any)', 'StockLunasHutangDetailController::update/$1');
$routes->get('stocklunashutangdetail/delete', 'StockLunasHutangDetailController::deletedata');

//stockOut
$routes->get('stockout', 'StockOutController::getStockOut');
$routes->get('stockout/all', 'StockOutController::allStockOut');
$routes->get('stockout/datacount', 'StockOutController::index');
$routes->get('stockout/detail', 'StockOutController::getStockOutbyid');
$routes->post('stockout/save', 'StockOutController::create');
$routes->post('stockout/update/(:any)', 'StockOutController::update/$1');
$routes->get('stockout/delete', 'StockOutController::deletedata');

//stockOut
$routes->get('stockoutdetail', 'StockOutDetailController::getStockOutDetail');
$routes->get('stockoutdetail/all', 'StockOutDetailController::allStockOutDetail');
$routes->get('stockoutdetail/datacount', 'StockOutDetailController::index');
$routes->get('stockoutdetail/detail', 'StockOutDetailController::getStockOutDetailbyid');
$routes->post('stockoutdetail/save', 'StockOutDetailController::create');
$routes->post('stockoutdetail/update/(:any)', 'StockOutDetailController::update/$1');
$routes->get('stockoutdetail/delete', 'StockOutDetailController::deletedata');

//stockPesanan
$routes->get('stockpesanan', 'StockPesananController::getStockPesanan');
$routes->get('stockpesanan/all', 'StockPesananController::allStockPesanan');
$routes->get('stockpesanan/datacount', 'StockPesananController::index');
$routes->get('stockpesanan/detail', 'StockPesananController::getStockPesananbyid');
$routes->post('stockpesanan/save', 'StockPesananController::create');
$routes->post('stockpesanan/update/(:any)', 'StockPesananController::update/$1');
$routes->get('stockpesanan/delete', 'StockPesananController::deletedata');

//stockPesananDetail
$routes->get('stockpesanandetail', 'StockPesananDetailController::getStockPesananDetail');
$routes->get('stockpesanandetail/all', 'StockPesananDetailController    ::allStockPesananDetail');
$routes->get('stockpesanandetail/datacount', 'StockPesananDetailController::index');
$routes->get('stockpesanandetail/detail', 'StockPesananDetailController::getStockPesananDetailbyid');
$routes->post('stockpesanandetail/save', 'StockPesananDetailController::create');
$routes->post('stockpesanandetail/update/(:any)', 'StockPesananDetailController::update/$1');
$routes->get('stockpesanandetail/delete', 'StockPesananDetailController::deletedata');

//stockPo
$routes->get('stockpo', 'StockPoController::getStockPo');
$routes->get('stockpo/all', 'StockPoController::allStockPo');
$routes->get('stockpo/closingbulanan', 'StockPoController::closingBulananFun');
$routes->get('stockpo/alldata', 'StockPoController::stockpodata');
$routes->get('stockpo/datacount', 'StockPoController::index');
$routes->get('stockpo/detail', 'StockPoController::getStockPobyid');
$routes->post('stockpo/save', 'StockPoController::create');
$routes->post('stockpo/update/(:any)', 'StockPoController::update/$1');
$routes->get('stockpo/delete', 'StockPoController::deletedata');


//closingbulanan
$routes->get('closingbulanan', 'ClosingbulananController::index');

//stockPoDetail
$routes->get('stockpodetail', 'StockPoDetailController::getStockPoDetail');
$routes->get('stockpodetail/all', 'StockPoDetailController::allStockPoDetail');
$routes->get('stockpodetail/datacount', 'StockPoDetailController::index');
$routes->get('stockpodetail/detail', 'StockPoDetailController::getStockPoDetailbyid');
$routes->post('stockpodetail/save', 'StockPoDetailController::create');
$routes->post('stockpodetail/update/(:any)', 'StockPoDetailController::update/$1');
$routes->get('stockpodetail/delete', 'StockPoDetailController::deletedata');

//stockPurch
$routes->get('stockpurch', 'StockPurchController::getStockPurch');
$routes->get('stockpurch/all', 'StockPurchController::allStockPurch');
$routes->get('stockpurch/datacount', 'StockPurchController::index');
$routes->get('stockpurch/detail', 'StockPurchController::getStockPurchbyid');
$routes->post('stockpurch/save', 'StockPurchController::create');
$routes->post('stockpurch/update/(:any)', 'StockPurchController::update/$1');
$routes->get('stockpurch/delete', 'StockPurchController::deletedata');
