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
Route::GET('usuarios/perfil', 'UsuarioController@show')->name('show_usuario');
Route::POST('usuarios/update/perfil', 'UsuarioController@updatePerfil')->name('update_usuario_perfil');

// Tipo de Transacciones
Route::GET('tipostransaccion/all', 'TipoTransaccionController@showAll');

// Gestores
Route::GET('transacciones/usuario', 'TransaccionesController@showConsultaUsuario')->name('consulta_usuario');

// Presolicitud
Route::GET('', 'PresolicitudController@index')->name('presolicitud');
Route::POST('presolicitud/save', 'PresolicitudController@store')->name('save_presolicitud');
Route::GET('presolicitud/edit/{id}', 'PresolicitudController@edit')->name('edit_presolicitud');
Route::POST('presolicitud/update', 'PresolicitudController@update')->name('update_presolicitud');

Route::middleware(['etapa:3'])->middleware(['role:Administrador'])->group(function () {
    Route::GET('transacciones/correos', 'CorreosController@index')->name('correos');
});

Route::middleware(['role:Administrador'])->group(function () {
    Route::GET('usuarios', 'UsuarioController@index')->name('usuarios');
    Route::GET('usuarios/all', 'UsuarioController@showAll');
    Route::PUT('usuarios/estado', 'UsuarioController@updateEstado');
    Route::GET('usuarios/edit/{id}', 'UsuarioController@edit')->name('edit_usuario');
    Route::GET('usuarios/nuevo', 'UsuarioController@newUser')->name('nuevo_usuario');
    Route::POST('usuarios/update', 'UsuarioController@update')->name('update_usuario');
    Route::POST('usuarios/nuevo/usuario', 'UsuarioController@store')->name('agregar_nuevo_usuario');
    Route::GET('usuarios/search/{data}', 'UsuarioController@showItem');
    Route::GET('usuarios/paginacion', 'UsuarioController@pagination');

    Route::GET('tipostransaccion', 'TipoTransaccionController@index')->name('tipos_transaccion');
    Route::POST('tipostransaccion', 'TipoTransaccionController@store');
    Route::PUT('tipostransaccion/update', 'TipoTransaccionController@update');
    Route::PUT('tipostransaccion/estado', 'TipoTransaccionController@updatEestado');
    Route::GET('tipostransaccion/search/{data}', 'TipoTransaccionController@show');
    Route::GET('tipostransaccion/paginacion', 'TipoTransaccionController@pagination');

    //Centros de Costo
    Route::GET('centrocostos', 'CentroCostosController@index')->name('centro_costos');
    Route::GET('centrocostos/search/{data}', 'CentroCostosController@show');
    Route::GET('centrocostos/paginacion', 'CentroCostosController@pagination');
    Route::POST('centrocostos', 'CentroCostosController@store');
    Route::PUT('centrocostos/update', 'CentroCostosController@update');
    Route::PUT('centrocostos/estado', 'CentroCostosController@updateEstado');

    //Documetos
    Route::GET('documentos', 'DocumentosController@index')->name('documentos');
    Route::POST('documentos/save', 'DocumentosController@store')->name('subir_documentos');
});

Route::middleware(['tipo_transaccion'])->group(function () {
    Route::POST('presolicitud', 'PresolicitudController@getEstado');
    Route::PUT('presolicitud/estado', 'PresolicitudController@setEstado');
    Route::GET('presolicitud/show/{id}', 'PresolicitudController@show')->name('show_presolicitud');
    Route::POST('presolicitud/redirect', 'PresolicitudController@redirect');
    Route::GET('presolicitud/proyecto/{id}', 'PresolicitudController@financieroProyecto');

    Route::POST('solicitud', 'SolicitudController@getEstado');
    Route::PUT('solicitud/estado', 'SolicitudController@setEstado');
    Route::GET('solicitud/index/{id}', 'SolicitudController@index')->name('solicitud');
    Route::POST('solicitud/save', 'SolicitudController@store')->name('save_solicitud');
    Route::GET('solicitud/show/{id}', 'SolicitudController@show')->name('show_solicitud');
    Route::GET('solicitud/edit/{id}', 'SolicitudController@edit')->name('edit_solicitud');
    Route::POST('solicitud/rubros', 'SolicitudController@getRubros');
    Route::POST('solicitud/update', 'SolicitudController@update')->name('update_solicitud');

    Route::POST('tramite', 'TramiteController@getEstado');
    Route::PUT('tramite/estado', 'TramiteController@setEstado');
    Route::GET('tramite/index/{id}', 'TramiteController@index')->name('tramite');
    Route::POST('tramite/save', 'TramiteController@store')->name('save_tramite');
    Route::GET('tramite/show/{id}', 'TramiteController@show')->name('show_tramite');
    Route::GET('tramite/edit/{id}', 'TramiteController@edit')->name('edit_tramite');
    Route::POST('tramite/update', 'TramiteController@update')->name('update_tramite');

    Route::POST('autorizado', 'AutorizadoController@getEstado');
    Route::PUT('autorizado/estado', 'AutorizadoController@setEstado');
    Route::GET('autorizado/index/{id}', 'AutorizadoController@index')->name('autorizado');
    Route::POST('autorizado/save', 'AutorizadoController@store')->name('save_autorizado');
    Route::GET('autorizado/show/{id}', 'AutorizadoController@show')->name('show_autorizado');
    Route::GET('autorizado/edit/{id}', 'AutorizadoController@edit')->name('edit_autorizado');
    Route::POST('autorizado/update', 'AutorizadoController@update')->name('update_autorizado');

    Route::POST('preaprobado', 'PreaprobadoController@getEstado');
    Route::PUT('preaprobado/estado', 'PreaprobadoController@setEstado');
    Route::GET('preaprobado/index/{id}', 'PreaprobadoController@index')->name('preaprobado');
    Route::POST('preaprobado/save', 'PreaprobadoController@store')->name('save_preaprobado');
    Route::GET('preaprobado/show/{id}', 'PreaprobadoController@show')->name('show_preaprobado');
    Route::GET('preaprobado/edit/{id}', 'PreaprobadoController@edit')->name('edit_preaprobado');
    Route::POST('preaprobado/update', 'PreaprobadoController@update')->name('update_preaprobado');

    Route::POST('aprobado', 'AprobadoController@getEstado');
    Route::PUT('aprobado/estado', 'AprobadoController@setEstado');
    Route::GET('aprobado/index/{id}', 'AprobadoController@index')->name('aprobado');
    Route::POST('aprobado/save', 'AprobadoController@store')->name('save_aprobado');
    Route::POST('aprobado/elements', 'AprobadoController@update_items');
    Route::GET('aprobado/show/{id}', 'AprobadoController@show')->name('show_aprobado');
    Route::GET('aprobado/edit/{id}', 'AprobadoController@edit')->name('edit_aprobado');
    Route::POST('aprobado/update', 'AprobadoController@update')->name('update_aprobado');

    Route::POST('reserva', 'ReservaController@getEstado');
    Route::PUT('reserva/estado', 'ReservaController@setEstado');
    Route::GET('reserva/index/{id}', 'ReservaController@index')->name('reserva');
    Route::POST('reserva/save', 'ReservaController@store')->name('save_reserva');
    Route::GET('reserva/show/{id}', 'ReservaController@show')->name('show_reserva');
    Route::GET('reserva/edit/{id}', 'ReservaController@edit')->name('edit_reserva');
    Route::POST('reserva/update', 'ReservaController@update')->name('update_reserva');

    Route::POST('pago', 'PagoController@getEstado');
    Route::PUT('pago/estado', 'PagoController@setEstado');
    Route::GET('pago/index/{id}', 'PagoController@index')->name('pago');
    Route::POST('pago/save', 'PagoController@store')->name('save_pago');
    Route::GET('pago/show/{id}', 'PagoController@show')->name('show_pago');
    Route::GET('pago/edit/{id}', 'PagoController@edit')->name('edit_pago');
    Route::POST('pago/update', 'PagoController@update')->name('update_pago');

    Route::POST('legalizado', 'LegalizadoController@getEstado');
    Route::PUT('legalizado/estado', 'LegalizadoController@setEstado');
    Route::GET('legalizado/index/{id}', 'LegalizadoController@index')->name('legalizado');
    Route::POST('legalizado/save', 'LegalizadoController@store')->name('save_legalizado');
    Route::GET('legalizado/show/{id}', 'LegalizadoController@show')->name('show_legalizado');
    Route::GET('legalizado/edit/{id}', 'LegalizadoController@edit')->name('edit_legalizado');
    Route::POST('legalizado/update', 'LegalizadoController@update')->name('update_legalizado');

    Route::GET('etapas', 'MainController@etapas')->name('etapas');

    Route::GET('transacciones/gestores', 'TransaccionesController@showConsultaGestores')->name('consulta_gestores');
    Route::GET('transacciones/gestores/show/{id}', 'TransaccionesController@show')->name('show_gestores');
});

Route::GET('documentos/download', 'DocumentosController@downloads')->name('descargar_documentos');
Route::POST('documentos/delete', 'DocumentosController@delete')->name('borrar_documento');

Auth::routes();

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
