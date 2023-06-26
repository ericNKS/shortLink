<?php

use Illuminate\Support\Facades\Route;

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
    if (isset($link)) {
        return view('home', ['link' => $link]);
    }
    if(isset($link_original) && isset($link_encurtado)){
        return view('welcome', ['link_original' => $link_original, 'link_encurtado' => $link_encurtado]);
    }

    return view('welcome');
    
})->name('home');
Route::get('/l/{link}', [App\Http\Controllers\LinkShortedController::class , 'redirecionar']);