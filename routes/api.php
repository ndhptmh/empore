<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{BookController,DataController};
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

Route::resource('/book', BookController::Class);
Route::get('/member', [DataController::class, 'member']);
Route::get('/bookloan', [DataController::class, 'bookloan']);
Route::get('/bookByCode/{book}', [BookController::class, 'showByCode']);
Route::put('/bookByCode/{book}', [BookController::class, 'updateByCode']);
Route::delete('/bookByCode/{book}', [BookController::class, 'destroyByCode']);