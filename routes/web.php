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
    return view('home');
});

Route::get('/players/{id}', function () {
    return view('player');
});

Route::get('/teams', function () {
    return view('teams');
});

Route::get('/teams/{id}', function () {
    return view('team');
});

Route::get('/match/{id}', function () {
    return view('match');
});

Route::get('/tournaments', function () {
    return view('tournaments');
});

Route::get('/transfers', function () {
    return view('transfers');
});

Route::get('/admin', function () {
    return view('admin');
});