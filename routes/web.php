<?php

use App\Http\Controllers\External\Administration\AdministrationController;
use App\Http\Controllers\External\Gallery\GalleryController;
use App\Http\Controllers\External\News\NewsController;
use App\Http\Controllers\External\Notice\NoticeController;
use App\Http\Controllers\External\Redirect\RedirectController;
use App\Http\Controllers\External\Result\ResultController;
use App\Http\Controllers\External\Rout\RoutController;
use App\Http\Controllers\External\RoutHistory\RoutHistoryController;
use App\Http\Controllers\Internal\Auth\AuthController;
use App\Http\Middleware\RequestLogger;
use App\Notifications\MailNotification;
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
    return view('main');
});

Route::group(['prefix' => 'api/external', 'middleware' => RequestLogger::class], static function () {
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('news', [NewsController::class, 'index'])->name('news');
    Route::get('notice', [NoticeController::class, 'index'])->name('notice');
    Route::get('result', [ResultController::class, 'index'])->name('result');
    Route::get('rout', [RoutController::class, 'index'])->name('rout');
    Route::get('rout-history', [RoutHistoryController::class, 'index'])->name('rout-history');
    Route::get('administration', [AdministrationController::class, 'index'])->name('administration');
    Route::get('redirect/{redirect}', [RedirectController::class, 'show'])->name('redirect');
});

Route::group(['prefix' => 'api/internal'], static function () {
   Route::post('auth/login', [AuthController::class, 'login']);
});
