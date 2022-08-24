<?php

use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;
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

Route::get('/login', fn()=>redirect("/admin/login"))->name("login");
Route::get('/', function () {
    return redirect('/admin');
});
Route::middleware(['auth'])->group(function(){
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::controller(UserController::class)->prefix('users')->name('users.')->group(function(){
        Route::get('/','index')->name('index');
    });
});

Route::get("/artisan",[ArtisanController::class,"run"]);

