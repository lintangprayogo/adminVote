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

Route::get('/','MainController@login');
Route::post('/main/checklogin', 'AuthController@checklogin');
Route::get('main/home', 'MainController@home');
Route::get('main/logout', 'MainController@logout');
Route::get("main/storeVoter", 'MainController@storeVoter')->name("store.voter");
Route::get("/voter/edit/{id}", 'MainController@getVoter');
Route::delete("/voter/delete/{id}",'MainController@deleteVoter');
Route::post("/voter/store/edit", 'MainController@saveVoter');
Route::post("voter/create", 'MainController@createVoter');
Route::post("voter/upload", 'MainController@importVoter');


Route::get("/candidate/storeCandidate", 'CandidateController@storeCandidate')->name("store.candidate");
Route::get("/candidate", 'CandidateController@index');
Route::post("/candidate/create", 'CandidateController@createCandidate');
Route::delete("/candidate/delete/{id}",'CandidateController@candidateDelete');
Route::get("/candidate/{id}", 'CandidateController@candidateProfile');
Route::post("/candidate/edit",'CandidateController@candidateEditProfile');

Route::get("/rekap", 'RekapController@index');
Route::get("/detail", 'RekapController@detail');
Route::get("/rekap/score", 'RekapController@displayAvg')->name("store.score");
Route::get("/detail/score", 'RekapController@storeDetailScore')->name("detail.score");
Route::get("/rekap/export", 'RekapController@export');
Route::get("/rekap/exportDetail","RekapController@exportDetail");