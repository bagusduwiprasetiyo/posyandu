<?php


Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/registration', 'KaderController@create');
Route::post('/postregistration', 'KaderController@store');
Route::get('/logout', 'AuthController@logout');


Route::get('/getAllKader', 'KaderController@getAllKader');


Route::get('/', 'Frontend\HomeController@index')->name('/');

Route::group(['middleware' => ['auth', 'checkLevel:1']], function () {

    Route::get('/accept_kader', 'KaderController@acceptKader');
    Route::get('/accept_kader/{id}/confirm', 'KaderController@acceptKaderConfirm');
    Route::get('/create_posyandu', 'MasterController@posyandu');
    Route::post('/create_posyandu', 'MasterController@store');
    Route::put('/create_posyandu/{id}/edit', 'MasterController@update');
    Route::delete('/create_posyandu/{id}/destroy', 'MasterController@destroy');

    Route::get('/antropometri_bbl', 'AntropometriController@antropometri_bbl');
    Route::post('/antropometri_bbl', 'AntropometriController@import_excel_bbl');
    Route::get('/antropometri_pbl', 'AntropometriController@antropometri_pbl');
    Route::post('/antropometri_pbl', 'AntropometriController@import_excel_pbl');
    Route::get('/antropometri_bbp', 'AntropometriController@antropometri_bbp');
    Route::post('/antropometri_bbp', 'AntropometriController@import_excel_bbp');
    Route::get('/antropometri_pbp', 'AntropometriController@antropometri_pbp');
    Route::post('/antropometri_pbp', 'AntropometriController@import_excel_pbp');
    Route::post('/add_admin', 'AccountController@add_admin');
});


Route::group(['middleware' => ['checkLevel:1,2']], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/accept_kader/{id}/destroy', 'KaderController@acceptKaderDestroy');
    Route::post('/postregistrationadmin', 'KaderController@storeAdmin');
    Route::get('/kader', 'KaderController@index');
    Route::get('/kader/{id}/detail', 'KaderController@detail');
    Route::put('/kader/{id}/update', 'KaderController@update');


    Route::get('/pasien', 'PasienController@index');
    Route::get('/pasien/create/', 'PasienController@create');
    Route::post('/pasien', 'PasienController@store');
    Route::get('/pasien/{id}/detail', 'PasienController@detail');
    Route::get('/pasien/{id}/edit', 'PasienController@create');
    Route::put('/pasien/{id}/update', 'PasienController@update');
    Route::get('/pasien/{id}/destroy', 'PasienController@destroy');

    Route::get('/pengantin', 'PengantinController@index');
    Route::get('/pengantin/create', 'PengantinController@create');
    Route::post('/pengantin', 'PengantinController@store');
    Route::get('/pengantin/{id}/detail', 'PengantinController@detail');
    Route::get('/pengantin/{id}/edit', 'PengantinController@edit');
    Route::put('/pengantin/{id}/update', 'PengantinController@update');
    Route::get('/pengantin/{id}/destroy', 'PengantinController@destroy');

    Route::get('/bumil', 'BumilController@index');
    Route::get('/bumil/create', 'BumilController@create');
    Route::post('/bumil', 'BumilController@store');
    Route::get('/bumil/{id}/detail', 'BumilController@detail');
    Route::get('/bumil/{id}/edit', 'BumilController@edit');
    Route::put('/bumil/{id}/update', 'BumilController@update');
    Route::get('/bumil/{id}/destroy', 'BumilController@destroy');

    #puswus
    Route::resource('puswus', PuswusController::class);
    Route::get('puswus/showall', 'PuswusController@showall');

    Route::get('/melahirkan', 'MelahirkanController@index');
    Route::get('/nifas', 'NifasController@index');

    Route::get('/bayi', 'BayiController@index');
    Route::get('/bayi/create', 'BayiController@create');
    Route::post('/bayi', 'BayiController@store');
    Route::get('/bayi/{id}/detail', 'BayiController@detail');
    Route::get('/bayi/{id}/edit', 'BayiController@edit');
    Route::put('/bayi/{id}/update', 'BayiController@update');
    Route::get('/bayi/{id}/destroy', 'BayiController@destroy');
    Route::get('/antropometri_bb/{umur}/{jk}', 'AntropometriController@antropometri_detail_bb');
    Route::get('/antropometri_pb/{umur}/{jk}', 'AntropometriController@antropometri_detail_pb');
    Route::get('/antropometri_pb/{umur}/{jk}', 'AntropometriController@antropometri_detail_pb');

    Route::get('/bayi_timbang/{id}', 'BayiController@detail_timbang');

    //profile
    Route::get('/account', 'AccountController@index');
    Route::post('/account', 'AccountController@store');
    Route::post('/account_edit', 'AccountController@updateIbu');
    Route::put('/account/{id}/edit', 'AccountController@edit');
    Route::get('/account/{id}/delete', 'AccountController@delete');
    Route::get('/get_account/{id}', 'AccountController@getData');

    //analisis
    Route::get('analisis', 'MasterController@analisis');
    Route::get('analisis/{id}/detail', 'MasterController@analisisDetail');
    Route::get('analisis_bayi/{tahun}/{id}', 'MasterController@analisis_bayi');
    Route::get('analisis_ibu/{tahun}/{id}', 'MasterController@analisis_ibu');


    //laporan registrasi 
    // Route::get('laporan_registrasi/{laporan}/{id}/{tahun}', 'LaporanRegistrasi@index');
    Route::get('laporan_registrasi_bumil/{id}/{tahun}', 'LaporanRegistrasi@bumil');
    Route::get('laporan_registrasi_bayi/{id}/{tahun}', 'LaporanRegistrasi@bayi');
    //laporan hasil kegiatan
    Route::get('laporan', 'LaporanController@index');
    Route::get('laporan_kegiatan_posyandu/{id}/{tahun}', 'LaporanKegiatan@index');
    Route::post('laporan/keterangan', 'LaporanKegiatan@keterangan');
    Route::get('print/hasil_kegiatan/{id}/{tahun}', 'LaporanKegiatan@print');
    //laporan jumlah pasien
    Route::get('laporan_jumlah_pengunjung/{id}/{tahun}', 'LaporanJumlahPengujung@index');
    Route::post('laporan_jumlah_pengunjung', 'LaporanJumlahPengujung@keterangan');
    Route::get('print/laporan_jumlah_pengunjung/{id}/{tahun}', 'LaporanJumlahPengujung@print');
    //laporan catatan bumil
    Route::get('laporan_catatan_bumil/{id}/{tahun}', 'CatatanBumil@index');
    Route::post('laporan_catatan_bumil', 'CatatanBumil@keterangan');
    Route::get('print/laporan_catatan_bumil/{id}/{tahun}', 'CatatanBumil@print');
    //laporan puswus
    Route::get('laporan_puswus/{id}/{tahun}', 'LaporanPuswus@index');
    Route::post('laporan_puswus', 'LaporanPuswus@keterangan');
    Route::get('print/laporan_puswus/{id}/{tahun}', 'LaporanPuswus@print');
    //laporan bulanan
    Route::get('laporan_bulanan/{id}/{tahun}/{bulan}', 'LaporanBulanan@index');
    Route::post('laporan_bulanan', 'LaporanBulanan@keterangan');
    Route::get('print/laporan_bulanan/{id}/{tahun}/{bulan}', 'LaporanBulanan@print');
    //sms
    Route::get('sms/kontak', 'SmsController@kontak');
    Route::get('sms/kontak/create', 'SmsController@create_kontak');
    Route::post('sms/store/kontak', 'SmsController@store_kontak');
    Route::get('sms/kontak/edit/{id}', 'SmsController@edit_kontak');
    Route::post('sms/edit/kontak', 'SmsController@update_kontak');
    Route::get('sms/kontak/{id}/delete', 'SmsController@delete_kontak');
    // send sms
    Route::get('sms/kirim', 'SmsController@kirim_sms');
    Route::get('sms/kirim/create', 'SmsController@create_kirim');
    Route::post('sms/store/kirim', 'SmsController@store_kirim');
    Route::get('sms/kirim/edit/{id}', 'SmsController@edit_kirim');
    Route::post('sms/edit/kirim', 'SmsController@update_kirim');
    Route::get('sms/kirim/{id}/delete', 'SmsController@delete_kirim');
    Route::get('sms/kirim/change_status/{id}', 'SmsController@change_status');
    Route::get('test_gateway', 'SmsController@gateway');
});

Route::group(['middleware' => ['checkLevel:1,2,3']], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/profile', 'ProfileController@index');
    Route::put('/profile/{id}/update', 'ProfileController@update');
});

Route::group(['middleware' => ['checkLevel:3']], function () {
    Route::get('/user', 'UserController@index');
    Route::get('/user_kehamilan', 'UserController@kehamilan');
    Route::get('/user_kehamilan/{id}/detail', 'UserController@detail_kehamilan');
    Route::get('/user_bayi', 'UserController@bayi');
    Route::get('/user_bayi/{id}/detail', 'UserController@detail_bayi');
});
