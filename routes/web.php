<?php

use App\Http\Controllers\AccountsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LineMessengerController;
use App\Http\Controllers\LiffController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LineUserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\RichMenuController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TemplateController;


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

// accounts routes
Route::get('accounts/{aid}/create/check', [AccountsController::class, 'check'])->name('accounts.check');
Route::resource('/accounts', AccountsController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home');

// friends routes
Route::get('accounts/{aid}/friends/{id}/chat', [LineUserController::class, 'sendChat'])->name('friends.chat');
Route::get('accounts/{aid}/friends', [LineUserController::class, 'index'])->name('friends.index');
Route::resource('accounts/{aid}/friends', LineUserController::class, ['except' => ['index']]);

// rich menu routes
Route::get('accounts/{aid}/richmenu/{id}/apply', [RichMenuController::class, 'richMenuApply'])->name('richmenu.apply');
Route::get('accounts/{aid}/richmenu', [RichMenuController::class, 'index'])->name('richmenu.index');
Route::resource('accounts/{aid}/richmenu', RichMenuController::class, ['except' => ['index']]);

// membership routes
Route::get('accounts/{aid}/membership/setting', [MembershipController::class, 'setting'])->name('membership.setting');
Route::post('accounts/{aid}/membership/privacy/update', [MembershipController::class, 'updatePrivacy'])->name('membership.update.privacy');
Route::post('accounts/{aid}/membership/{id}/update', [MembershipController::class, 'update'])->name('membership.update');
Route::get('accounts/{aid}/membership/privacy', [MembershipController::class, 'privacy'])->name('membership.privacy');
Route::get('accounts/{aid}/membership/{id}', [MembershipController::class, 'membership'])->name('membership');

// chat routes
Route::get('accounts/{aid}/chat/list', [ChatController::class, 'chatList'])->name('chat.list');
Route::post('accounts/{aid}/chat/setting/update', [ChatController::class, 'settingUpdate'])->name('chat.setting.update');
Route::get('accounts/{aid}/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('accounts/{aid}/chat/setting', [ChatController::class, 'setting'])->name('chat.setting');
Route::post('accounts/{aid}/chat/{id}', [ChatController::class, 'store'])->name('chat.store');
Route::resource('accounts/{aid}/chat', ChatController::class, ['except' => ['index', 'store']]);

// tag routes
// Route::get('accounts/{aid}/tag/{id}/setting', [TagController::class, 'setting'])->name('tag.setting');
Route::get('accounts/{aid}/tag', [TagController::class, 'index'])->name('tag.index');
Route::resource('accounts/{aid}/tag', TagController::class, ['except' => ['index']]);

// template routes
Route::get('accounts/{aid}/template', [TemplateController::class, 'index'])->name('template.index');
Route::resource('accounts/{aid}/template', TemplateController::class, ['except' => ['index']]);




// LINE Routes
Route::group(['prefix' => 'line'], function () {

    // LINE recieve message
    Route::post('{aid}/webhook', [LineMessengerController::class, 'webhook']);

    // LINE send message
    Route::get('{aid}/send', [LineMessengerController::class, 'sendMessage']);

    // LINE rich menu create/upload/
    Route::get('{aid}/richmenu/create', [LineMessengerController::class, 'richMenuCreate']);

    // LINE rich menu delete
    Route::get('{aid}/richmenu/delete', [LineMessengerController::class, 'richMenuDelete']);
});


// Liff sample
Route::get('/liff/sample', [LiffController::class, 'liff'])->name('liff');