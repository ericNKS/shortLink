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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/encurtador', App\Http\Controllers\OriginalLinkController::class);


Route::get('/ul/{id}', [App\Http\Controllers\LinkShortedController::class , 'show']);
Route::delete('/ul/{id}', [App\Http\Controllers\LinkShortedController::class , 'destroy']);
Route::post('/l', [App\Http\Controllers\LinkShortedController::class , 'store']);