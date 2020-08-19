<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');
Route::post('/logout', 'UserController@logout');

Route::prefix('/posts')->middleware('auth:api')->group(function() {
    Route::post('/', 'PostController@create');
    Route::get('/', 'PostController@all');
    
    Route::patch('/{post_id}/like', 'PostController@addLike');
    Route::delete('/{post_id}/like', 'PostController@rmvLike');
});