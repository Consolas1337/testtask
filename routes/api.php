<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;

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

Route::prefix('comments')->group(function () {
    Route::get('/get-all', 'CommentsController@index');
    Route::post('/post-comment', 'CommentsController@store');
    Route::post('/like', 'CommentsController@like');
    Route::post('/dislike', 'CommentsController@dislike');
    Route::delete('/delete', 'CommentsController@destroy');
});
