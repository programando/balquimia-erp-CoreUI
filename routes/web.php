<?php


//Route::get('prueba', 'MstroLineasController@prueba');

Route::middleware(['auth'])->group(function () {
    Route::get('/',                     'DashBoardController@Index')->name('dashboad');
    Route::get('cargos',           'MstroCargosController@showForm')->name('mstro.cargos.show.form');
    Route::get('lineas',      'MstroLineasController@showForm')->name('mstro.lineas.show.form');

    //Route::resource('medidas',          'PrdUnidsMedidaController', ['except'=>'edit','create']);
    /*Route::get('/menu-load',            'DashBoardController@MenuLoad')->name('menu.load');
    Route::get('unidades-medidas',      'PrdUnidsMedidaController@showForm')->name('prd.undmed.show.form');

    Route::get('cargos-perfiles',       'RhCargosController@showForm')->name('gral.cargos.show.form');

    */
   // Route::resource('lineas',           'MstroLineasController', ['except'=>'edit','create']);
});
/** LOGIN */
/*-----------------*/
Route::get('login'  , 'LoginController@ShowLogin')->name('login.show');
Route::post('login' , 'LoginController@PostLogin')->name('login');
Route::get('logout' , 'LoginController@getLogOut')->name('cerrar-sistema');
/** PASSWORD RESET */
/*-----------------*/
Route::get('reset-password'           , 'LoginController@PasswordRememberShowForm')->name('password.reset.show.form');
Route::post('reset-password'          , 'LoginController@PasswordResetSendMail')->name('reset-password');
Route::get('update-password/{token}'  , 'LoginController@UpdatePasswordShowForm')->name('update-password');
Route::post('update-password'         , 'LoginController@UpdatePassword')->name('update-password');
/*
Route::middleware(['VerifyAutenticationAndRequestJson'])->group(function () {
    Route::resource('cargos',         'MstroCargosController',       ['except'=>'edit','create']);
    Route::resource('lineas',         'MstroLineasController',       ['except'=>'edit','create']);
    Route::resource('medidas',        'MstroUndsMedidaController',   ['except'=>'edit','create']);
});


Route::get('sublineas-linea/{idlinea}',     'MstroLineasSubLineasController@FaltantesPorLinea');
Route::middleware(['auth'])->group(function () {
    Route::get('/{any?}',             'DashBoardController@Index')->name('dashboad')->where('any','.*');
});
*/


