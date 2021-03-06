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
Route::get('/tournaments/participants', 'TournamentController@TourParticipants');
Route::get('/matches', 'MatchesController@matches');
Route::get('/players', 'PlayerController@players');


Route::post('/tournaments', 'TournamentController@insert');
Route::post('/tournamentParticipants', 'TournamentController@InsertParticipants');
Route::post('/group', 'TournamentController@InsertGroup');
Route::post('/trophy', 'TournamentController@InsertTrophy');
