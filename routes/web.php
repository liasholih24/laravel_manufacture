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
    Route::get('area', ['uses' => 'LokasiController@area']);
    Route::get('area/create', ['uses' => 'LokasiController@creates']);
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
    Route::resource('posts', 'PostsController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('penjualan', 'PenjualanController');
    Route::get('penjualan/customer/{id}', 'PenjualanController@customer');
    Route::get('penjualan/{id}/print', ['uses' => 'PenjualanController@print', 'as' => 'penjualan.print']);
    Route::get('/refpj', 'PenjualanController@refpj');
    Route::get('/cekstock', 'PenjualanController@cekstock');
    Route::get('pos', 'PenjualanController@pos');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('stocks', ['uses' => 'LaporanController@stocks', 'as' => 'laporan.stocks']);
    Route::get('/stocksapi', 'LaporanController@stocksapi');

    Route::get('laporan/penjualan', ['uses' => 'LaporanController@penjualan', 'as' => 'laporan.penjualan']);
    Route::get('laporan/pembelian', ['uses' => 'LaporanController@pembelian', 'as' => 'laporan.pembelian']);
    Route::get('/penjualanapi', 'LaporanController@penjualanapi');
    Route::get('/pembelianapi', 'LaporanController@pembelianapi');


});

Route::group(['middleware' => ['web']], function () {
    Route::get('rekapitulasi/stocks', ['uses' => 'RekapitulasiController@stocks', 'as' => 'rekapitulasi.stocks']);
    Route::get('/rekstocksapi', 'RekapitulasiController@rekstocksapi');
  
   
});

Route::group(['middleware' => ['web']], function () {

    Route::get('recording', ['uses' => 'LaporanProduksiController@recording', 'as' => 'laporan.recording']);
    Route::get('/recordingapi', 'LaporanProduksiController@recordingapi');

});

Route::group(['middleware' => ['web']], function () {
    Route::resource('transfer', 'TransferController');
    Route::get('transfer/{id}/print', ['uses' => 'TransferController@print', 'as' => 'transfer.print']);
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('pengajuan', 'PengajuanController');
    Route::post('pengajuan/{id}/verifikasi', 'PengajuanController@verifikasi');
    Route::get('pengajuan/item/{id}', 'PengajuanController@item');
    Route::get('pengajuan/{id}/print', ['uses' => 'PengajuanController@print', 'as' => 'pengajuan.print']);
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('penerimaan', 'PenerimaanController');
    Route::get('penerimaan/pengajuan/{id}', 'PenerimaanController@pengajuan');
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('pemakaian', 'PemakaianController');
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('pengeluaran', 'PengeluaranController');
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('customer', 'CustomerController');
});

Route::group(['middleware' => ['web']], function () {
    Route::resource('ekspedisi', 'EkspedisiController');
});

Route::group(['middleware' => ['web']], function () {
	Route::resource('brand', 'BrandController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('supplier', 'SupplierController');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('pakan', 'pakanController');
    Route::get('/getharga', 'pakanController@getharga');
});
Route::group(['middleware' => ['web']], function () {
    Route::resource('produksi', 'ProduksiController');
    Route::get('/jmlakhir', 'ProduksiController@jmlakhir');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('pengobatan', 'PengobatanController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('hpp', 'HppController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('hargapokok', 'HargaPokokController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('standarlayer', 'StandarLayerController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('standargrower', 'StandarGrowerController');
});
Route::group(['middleware' => ['web']], function () {
	Route::resource('standarfc', 'StandarFcController');
});