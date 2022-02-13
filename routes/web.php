<?php

use App\Http\Controllers\AccountsController;
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


// Dashboard Routes
Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/default', [DashboardController::class, 'default'])->name('default');
Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
Route::get('/billing', [DashboardController::class, 'billing'])->name('billing');
Route::get('/wizard', [DashboardController::class, 'wizard'])->name('wizard');
Route::get('/friends', [DashboardController::class, 'friends'])->name('friends');
Route::get('/chat', [DashboardController::class, 'chat'])->name('chat');

Route::get('/accounts/{id}/richmenu/', [AccountsController::class, 'richmenu'])->name('accounts.richmenu');
Route::resource('/accounts', AccountsController::class);


Route::get('/home', [HomeController::class, 'index'])->name('home');





// LINE Routes
Route::group(['prefix' => 'line'], function () {

    // LINE recieve message
    Route::post('webhook', [LineMessengerController::class, 'webhook'])->name('line.webhook');

    // LINE send message
    Route::get('{aid}/send', [LineMessengerController::class, 'sendMessage']);

    // LINE rich menu create/upload/
    Route::get('richmenu/create', [LineMessengerController::class, 'richMenuCreate']);

    // LINE rich menu delete
    Route::get('richmenu/delete', [LineMessengerController::class, 'richMenuDelete']);
});


// Liff sample
Route::get('/liff/sample', [LiffController::class, 'liff'])->name('liff');