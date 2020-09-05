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

// Usuarios
Route::GET('/usuarios/perfil', 'UsuarioController@edit')->name('edit_usuario');
Route::POST('/usuarios/perfil/update', 'UsuarioController@update')->name('update_usuario');

Route::middleware(['role:Administrador'])->group(function () {
    Route::GET('/usuarios', 'UsuarioController@index')->name('usuarios');
    Route::POST('/usuarios/nuevo/usuario', 'UsuarioController@store')->name('agregar_nuevo_usuario');
    Route::GET('/usuarios/nuevo', 'UsuarioController@create')->name('nuevo_usuario');
    Route::GET('/usuarios/all', 'UsuarioController@showAll');

});

// Tipo de Transacciones
Route::GET('/tipostransaccion/all', 'TipoTransaccionController@showAll');
Route::GET('/tipostransaccion/search/{data}', 'TipoTransaccionController@show');
Route::GET('/tipostransaccion/paginacion', 'TipoTransaccionController@pagination');

Route::middleware(['role:Administrador'])->group(function () {
    Route::GET('/tipostransaccion', 'TipoTransaccionController@index')->name('tipos_transaccion');
    Route::POST('/tipostransaccion', 'TipoTransaccionController@store');
    Route::PUT('/tipostransaccion/update/{data}', 'TipoTransaccionController@update');
    Route::PUT('/tipostransaccion/estado', 'TipoTransaccionController@update_estado');
});

//Proyectos
Route::GET('/proyectos', 'ProyectosController@index')->name('proyectos');
Route::GET('/proyectos/search/{data}', 'ProyectosController@show');
Route::GET('/proyectos/paginacion', 'ProyectosController@pagination');
Route::POST('/proyectos', 'ProyectosController@store');
Route::PUT('/proyectos/update/{data}', 'ProyectosController@update');
Route::PUT('/proyectos/estado', 'ProyectosController@update_estado');

//Centros de Costo
Route::GET('/centrocostos', 'CentroCostosController@index')->name('centro_costos');
Route::GET('/centrocostos/search/{data}', 'CentroCostosController@show');
Route::GET('/centrocostos/paginacion', 'CentroCostosController@pagination');
Route::POST('/centrocostos', 'CentroCostosController@store');
Route::PUT('/centrocostos/update/{data}', 'CentroCostosController@update');
Route::PUT('/centrocostos/estado', 'CentroCostosController@update_estado');


Route::GET('/', 'PresolicitudController@index')->name('presolicitud');
Route::GET('/presolicitud/show/{id}', 'PresolicitudController@show');
Route::GET('/presolicitud/edit/{id}', 'PresolicitudController@edit')->name('edit_presolicitud');
Route::POST('/presolicitud/save', 'PresolicitudController@store')->name('save_presolicitud');
Route::POST('/presolicitud/update/{id}', 'PresolicitudController@update')->name('update_presolicitud');
Route::PUT('/presolicitud/redirect/{id}', 'PresolicitudController@redirect');

Route::post('/solicitud', 'SolicitudController@store')->name('solicitud');
Route::post('/solicitud/save', 'SolicitudController@store')->name('save_solicitud');
Route::GET('/solicitud/show/{id}', 'SolicitudController@show')->name('showSolicitud');
Route::GET('/solicitud/edit/{id}', 'SolicitudController@edit')->name('edit_solicitud');
Route::post('/solicitud/update/{id}', 'SolicitudController@update')->name('updatesolicitud');

Route::post('/tramite', 'TramiteController@store')->name('save_tramite');
Route::GET('/tramite/show/{id}', 'TramiteController@show')->name('showTramite');
Route::GET('/tramite/edit/{id}', 'TramiteController@edit')->name('edit_tramite');
Route::post('/tramite/update/{id}', 'TramiteController@update')->name('updateTramite');

Route::post('/autorizado', 'AutorizadoController@store')->name('save_autorizado');
Route::GET('/autorizado/show/{id}', 'AutorizadoController@show')->name('showAutorizado');
Route::GET('/autorizado/edit/{id}', 'AutorizadoController@edit')->name('edit_autorizado');
Route::post('/autorizado/update/{id}', 'AutorizadoController@update')->name('updateAutorizado');

Route::post('/preaprobado', 'PreaprobadoController@store')->name('save_preaprobado');
Route::GET('/preaprobado/show/{id}', 'PreaprobadoController@show')->name('showPreaprobado');
Route::GET('/preaprobado/edit/{id}', 'PreaprobadoController@edit')->name('edit_preaprobado');
Route::post('/preaprobado/update/{id}', 'PreaprobadoController@update')->name('updatePreaprobado');

Route::post('/aprobado', 'AprobadoController@store')->name('save_aprobado');
Route::GET('/aprobado/show/{id}', 'AprobadoController@show')->name('showAprobado');
Route::GET('/aprobado/edit/{id}', 'AprobadoController@edit')->name('edit_aprobado');
Route::post('/aprobado/update/{id}', 'AprobadoController@update')->name('updateAprobado');

Route::post('/reserva', 'ReservaController@store')->name('save_reserva');
Route::GET('/reserva/show/{id}', 'ReservaController@show')->name('showReserva');
Route::GET('/reserva/edit/{id}', 'ReservaController@edit')->name('edit_reserva');
Route::post('/reserva/update/{id}', 'ReservaController@update')->name('updateReserva');

Route::post('/pago', 'PagoController@store')->name('save_pago');
Route::GET('/pago/show/{id}', 'PagoController@show')->name('showPago');
Route::GET('/pago/edit/{id}', 'PagoController@edit')->name('edit_pago');
Route::post('/pago/update/{id}', 'PagoController@update')->name('updatePago');

Route::post('/legalizado', 'LegalizadoController@store')->name('save_legalizado');
Route::GET('/legalizado/show/{id}', 'LegalizadoController@show')->name('showLegalizado');
Route::GET('/legalizado/edit/{id}', 'LegalizadoController@edit')->name('edit_legalizado');
Route::post('/legalizado/update/{id}', 'LegalizadoController@update')->name('updateLegalizado');

Route::GET('/transacciones', 'TransaccionesController@index')->name('transacciones');
Route::GET('/transacciones/show/{id}', 'TransaccionesController@show');
Route::middleware(['etapa:3'])->group(function () {
    Route::GET('/transacciones/correos', 'TransaccionesController@emails')->name('correos');
});

Auth::routes();

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
