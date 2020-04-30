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

Route::get('/', function () {
    return view('menu');
});

Route::get('/general', function () {
    return view('general');
});

Route::get('/presolicitud', function () {
    return view('preSolicitud');
});

Route::get('/confirmarpresolicitud', function () {
    return view('confirmarPreSolicitud');
});
