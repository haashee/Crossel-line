<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LineMessengerController;
use App\Http\Controllers\LiffController;
use App\Http\Controllers\HomeController;


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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/line/liff', [LiffController::class, 'liff'])->name('liff');

// LINE recieve message
Route::post('/line/webhook', [LineMessengerController::class, 'webhook'])->name('line.webhook');

// LINE send message
Route::get('/line/send', [LineMessengerController::class, 'sendMessage']);

// LINE rich menu create/upload/
Route::get('/line/richmenu/create', [LineMessengerController::class, 'richMenuCreate']);

// LINE rich menu delete
Route::get('/line/richmenu/delete', [LineMessengerController::class, 'richMenuDelete']);