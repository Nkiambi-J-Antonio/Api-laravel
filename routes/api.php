<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\CommentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 Route::resource('autor',AutorController::class);
 Route::resource('article',ArticleController::class);
 Route::get('articles/autor/{autor_id}',[ArticleController::class,'getArticlesByAutorId']);
 Route::resource('comment',CommentController::class);
 Route::get('comments/article/{article_id}',[CommentController::class,'getCommentsByArticleId']);


