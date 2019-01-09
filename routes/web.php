<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::auth();

 Route::group(['middleware' => ['web', 'auth', 'permission'] ], function () {

    Route::get('/', ['uses' => 'Auth\LoginController@login']);
     Route::get('dashboard', ['uses' => 'HomeController@dashboard', 'as' => 'home.dashboard']);
     //users
     Route::resource('user', 'UserController', ['except' => ['destroy']]);
     Route::get('user/{role}/role', ['uses' => 'UserController@role']);

     //Route::get('user/{user}/activate', ['uses' => 'UserController@activate', 'as' => 'user.activate']);
     //Route::get('user/{user}/deactivate', ['uses' => 'UserController@deactivate', 'as' => 'user.deactivate']);

     Route::post('user/ajax_all', ['uses' => 'UserController@ajax_all']);

     //roles
     Route::resource('role', 'RoleController', ['except' => ['destroy','show']]);
     Route::post('role/{role}/save', ['uses' => 'RoleController@save' , 'as' => 'role.save']);
     Route::post('role/store', ['uses' => 'RoleController@store']);
     Route::post('role/check', ['uses' => 'RoleController@check']);
     Route::get('role/{id}/show', ['uses' => 'RoleController@show', 'as' => 'role.show']);
     Route::get('role/{id}/{module}/permissions', ['uses' => 'RoleController@permissions']);
 });



Route::group(['middleware' => ['web','auth', 'permission']], function () {
    Route::resource('status', 'StatusController', ['except' => ['destroy','show']]);
    Route::get('status/{id}/filter', ['uses' => 'StatusController@filter']);
    Route::get('status/{id}/show', ['uses' => 'StatusController@show', 'as' => 'status.show']);
});

Route::group(['middleware' => ['web','auth', 'permission']], function () {
    Route::resource('lokasi', 'LokasiController');
    Route::get('lokasi/{id}/filter', ['uses' => 'LokasiController@filter']);
});



  Route::group(['middleware' => ['web','auth', 'permission']], function () {
      Route::resource('sampah', 'SampahController', ['except' => ['show']]);
      Route::post('sampah/store', ['uses' => 'SampahController@store']);
      Route::get('sampah/{id}/filter', ['uses' => 'SampahController@filter']);
      Route::get('sampah/{id}/show', ['uses' => 'SampahController@show', 'as' => 'sampah.show']);
      Route::get('sampah/{id}/create', ['uses' => 'SampahController@creates']);
      Route::get('kategori', ['uses' => 'SampahController@kategori','as' => 'kategori.index']);
  });

  Route::group(['middleware' => ['web','auth', 'permission']], function () {
    Route::resource('item', 'ItemController', ['except' => ['show']]);
    Route::post('item/store', ['uses' => 'ItemController@store']);
    Route::get('item/{id}/filter', ['uses' => 'ItemController@filter']);
    Route::get('item/{id}/show', ['uses' => 'ItemController@show', 'as' => 'item.show']);
    Route::get('item/{id}/create', ['uses' => 'ItemController@creates']);
    Route::get('kategori', ['uses' => 'ItemController@kategori','as' => 'kategori.index']);
});

Route::group(['middleware' => ['web','auth', 'permission']], function () {
    Route::get('log', ['uses' => 'LogController@index', 'as' => 'log.index']);
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('satuan', 'SatuanController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('penadah', 'PenadahController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('nasabah', 'NasabahController');
    Route::get('nasabah/{id}/print', ['uses' => 'NasabahController@print', 'as' => 'nasabah.print']);
    Route::get('/getnorek', 'NasabahController@getnorek');
    Route::get('/datanasabah', 'NasabahController@datanasabah');
    Route::get('/ceksaldo', 'NasabahController@ceksaldo');
    Route::post('prints', 'NasabahController@prints');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('tabungan', 'TabunganController');
    Route::get('tabungan/{id}/print', ['uses' => 'TabunganController@print', 'as' => 'tabungan.print']);
    Route::get('/getharga', 'TabunganController@getharga');
    Route::get('/getsatuan', 'TabunganController@getsatuan');
    Route::get('/gettrxcode', 'TabunganController@gettrxcode');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('posts', 'PostsController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('penjualan', 'PenjualanController');
    Route::get('penjualan/{id}/print', ['uses' => 'PenjualanController@print', 'as' => 'penjualan.print']);
    Route::get('/refpj', 'PenjualanController@refpj');
    Route::get('/cekstock', 'PenjualanController@cekstock');
    Route::get('pos', 'PenjualanController@pos');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('sedekah', 'SedekahController');
    Route::get('sedekah/{id}/print', ['uses' => 'SedekahController@print', 'as' => 'sedekah.print']);
});
Route::group(['middleware' => ['web']], function () {
    Route::get('stocks', ['uses' => 'LaporanController@stocks', 'as' => 'laporan.stocks']);
    Route::get('/stocksapi', 'LaporanController@stocksapi');

    Route::get('laporan/tabungan', ['uses' => 'LaporanController@tabungan', 'as' => 'laporan.tabungan']);
    Route::get('/tabunganapi', 'LaporanController@tabunganapi');
    Route::get('laporan/sedekah', ['uses' => 'LaporanController@sedekah', 'as' => 'laporan.sedekah']);
    Route::get('/sedekahapi', 'LaporanController@sedekahapi');
    Route::get('laporan/penjualan', ['uses' => 'LaporanController@penjualan', 'as' => 'laporan.penjualan']);
    Route::get('laporan/pembelian', ['uses' => 'LaporanController@pembelian', 'as' => 'laporan.pembelian']);
    Route::get('/penjualanapi', 'LaporanController@penjualanapi');
    Route::get('/pembelianapi', 'LaporanController@pembelianapi');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('rekapitulasi/stocks', ['uses' => 'RekapitulasiController@stocks', 'as' => 'rekapitulasi.stocks']);
    Route::get('/rekstocksapi', 'RekapitulasiController@rekstocksapi');
    Route::get('rekapitulasi/tabungan', ['uses' => 'RekapitulasiController@tabungan', 'as' => 'rekapitulasi.tabungan']);
    Route::get('/rektabunganapi', 'RekapitulasiController@rektabunganapi');
   
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('transfer', 'TransferController');
    Route::get('transfer/{id}/print', ['uses' => 'TransferController@print', 'as' => 'transfer.print']);
});

Route::group(['middleware' => ['web']], function () {
	Route::resource('pembelian', 'PembelianController');
    Route::get('pembelian/{id}/print', ['uses' => 'PembelianController@print', 'as' => 'pembelian.print']);
    Route::get('/refpb', 'PembelianController@refpb');
    Route::get('/getharga', 'PembelianController@getharga');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('brand', 'BrandController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('supplier', 'SupplierController');
});