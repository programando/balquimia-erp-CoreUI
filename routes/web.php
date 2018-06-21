<?php
 Route::get('/terceros/buscar','TercerosController@ClientesLista' );
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

Route::middleware(['VerifyUserRequestJson'])->group(function () {
   Route::resource('/cargos'        , 'MstroCargosController'             ,['except'=>'edit','create', 'show'] );
   Route::resource('/medidas'       , 'MstroUndsMedidaController'         ,['except'=>'edit','create', 'show'] );
   Route::resource('/lineas'        , 'MstroLineasController'             ,['except'=>'edit','create', 'show'] );
   Route::delete('/sublineas-destroy/{idsub}/{idline}'     , 'MstroLineasController@SubLineasBorrarAsocc',
                                                                           ['except'=>'edit','create', 'show'] );
   Route::resource('/sublineas'     , 'MstroLineasSubLineasController'    ,['except'=>'edit','create', 'show'] );
   Route::get('/sublineas-show'     , 'MstroLineasSubLineasController@ConsultaSubLineas');

   Route::get('/terceros/clientes/buscar','TercerosController@ClientesLista' );
});
Route::get('/{any?}'             , 'DashBoardController@Index')->name('dashboad')->where('any','.*');




