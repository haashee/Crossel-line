<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LineMessengerController;
use App\Http\Controllers\LiffController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;


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


Auth::routes();


Route::get('/', [DashboardController::class, 'index'])->name('index');
Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
Route::get('/billing', [DashboardController::class, 'billing'])->name('billing');
Route::get('/wizard', [DashboardController::class, 'wizard'])->name('wizard');
Route::get('/friends', [DashboardController::class, 'friends'])->name('friends');
Route::get('/accounts-list', [DashboardController::class, 'accountsList'])->name('accounts');
Route::get('/account', [DashboardController::class, 'account'])->name('account');


Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::group(['prefix' => 'line'], function () {

    // LINE recieve message
    Route::post('webhook', [LineMessengerController::class, 'webhook'])->name('line.webhook');

    // LINE send message
    Route::get('send', [LineMessengerController::class, 'sendMessage']);

    // LINE rich menu create/upload/
    Route::get('richmenu/create', [LineMessengerController::class, 'richMenuCreate']);

    // LINE rich menu delete
    Route::get('richmenu/delete', [LineMessengerController::class, 'richMenuDelete']);
});


// Liff sample
Route::get('/liff/sample', [LiffController::class, 'liff'])->name('liff');