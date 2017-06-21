<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teams', 'TeamController@teams');
Route::get('/countries', 'CountryController@countries');
Route::get('/regions', 'RegionController@regions');
Route::get('/transfers', 'TransferController@transfers');
Route::get('/tournaments', 'TournamentController@tournaments');
Route::get('/tournament/participants', 'TournamentController@participants');
