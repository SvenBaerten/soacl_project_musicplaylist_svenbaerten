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
    return view('welcome');
});

Route::get('/', 'MainController@index');
Route::get('/documentation', 'MainController@getDocumentation');
Route::get('/playlists/playlistswithsongs', 'PlaylistController@getPlaylistsWithSongs');
Route::resource('/playlists', 'PlaylistController');
Route::resource('/songs', 'SongController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'AuthController@getUserView');