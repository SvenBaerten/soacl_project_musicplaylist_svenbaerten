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

// Authentication from https://medium.com/modulr/create-api-authentication-with-passport-of-laravel-5-6-1dc2d400a7f
Route::group([
    'prefix' => 'auth'
    ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');
    
        Route::group([
        'middleware' => 'auth:api'
        ], function() {
            Route::get('logout', 'AuthController@logout');
            Route::get('user', 'AuthController@user');
        });
    }
);

Route::resource('/playlists', 'PlaylistAPIController')->middleware('auth:api');
Route::get('/getLyricsByArtistTitle', 'SongLyricsController@getLyricsByArtistTitle');
