<?php

use App\Http\Controllers\Internal\ActivityLog\ActivityLogController;
use App\Http\Controllers\Internal\Administration\AdministrationController;
use App\Http\Controllers\Internal\Asset\AssetController;
use App\Http\Controllers\Internal\Auth\AuthController;
use App\Http\Controllers\Internal\Dashboard\DashboardController;
use App\Http\Controllers\Internal\GalleryAlbum\GalleryAlbumController;
use App\Http\Controllers\Internal\GalleryImage\GalleryImageController;
use App\Http\Controllers\Internal\LoginLog\LoginLogController;
use App\Http\Controllers\Internal\Mail\MailController;
use App\Http\Controllers\Internal\MailReceiverGroup\MailReceiverGroupController;
use App\Http\Controllers\Internal\News\NewsController;
use App\Http\Controllers\Internal\Notice\NoticeController;
use App\Http\Controllers\Internal\Result\ResultController;
use App\Http\Controllers\Internal\Rout\RoutController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'internal', 'middleware' => 'auth:api'], static function () {

    /*
     * Auth
     */
    Route::group(['prefix' => 'auth'], static function () {
        Route::get('', [AuthController::class, 'getAuth']);
        Route::post('logout', [AuthController::class, 'logout']);
    });

    /*
     * Dashboard
     */
    Route::group(['prefix' => 'dashboard'], static function () {
        Route::get('requests-today', [DashboardController::class, 'requestsToday']);
        Route::get('requests-month', [DashboardController::class, 'requestsMonth']);
    });

    /*
     * Notice
     */
    Route::group(['prefix' => 'notices'], static function () {
        Route::get('', [NoticeController::class, 'index']);
        Route::post('', [NoticeController::class, 'store']);
        Route::put('{notice}', [NoticeController::class, 'update']);
        Route::delete('{notice}', [NoticeController::class, 'delete']);
    });

    /*
     * News
     */
    Route::group(['prefix' => 'news'], static function () {
        Route::get('', [NewsController::class, 'index']);
        Route::post('', [NewsController::class, 'store']);
        Route::put('{news}', [NewsController::class, 'update']);
        Route::delete('{news}', [NewsController::class, 'delete']);
    });

    /*
     * Rout
     */
    Route::group(['prefix' => 'routs'], static function () {
        Route::get('', [RoutController::class, 'index']);
        Route::post('', [RoutController::class, 'store']);
        Route::put('{rout}', [RoutController::class, 'update']);
        Route::delete('{rout}', [RoutController::class, 'delete']);
    });

    /*
     * Administration
     */
    Route::group(['prefix' => 'administrations'], static function () {
        Route::get('', [AdministrationController::class, 'index']);
        Route::post('', [AdministrationController::class, 'store']);
        Route::put('{administration}', [AdministrationController::class, 'update']);
        Route::delete('{administration}', [AdministrationController::class, 'delete']);
    });

    /*
     * Result
     */
    Route::group(['prefix' => 'results'], static function () {
        Route::get('', [ResultController::class, 'index']);
        Route::post('redirect', [ResultController::class, 'storeRedirect']);
        Route::post('download', [ResultController::class, 'storeDownload']);
        Route::put('{result}', [ResultController::class, 'update']);
        Route::delete('{result}', [ResultController::class, 'delete']);
    });

    /*
     * Gallery
     */
    Route::group(['prefix' => 'gallery'], static function () {
        /*
         * Albums
         */
        Route::group(['prefix' => 'albums'], static function () {
            Route::get('', [GalleryAlbumController::class, 'index']);
            Route::post('', [GalleryAlbumController::class, 'store']);
            Route::get('{galleryAlbum}', [GalleryAlbumController::class, 'show']);
            Route::delete('{galleryAlbum}', [GalleryAlbumController::class, 'delete']);
        });

        /*
         * Images
         */
        Route::group(['prefix' => 'images'], static function () {
            Route::post('', [GalleryImageController::class, 'store']);
            Route::delete('{galleryImage}', [GalleryImageController::class, 'delete']);
        });
    });

    /*
     * ActivityLog
     */
    Route::group(['prefix' => 'activity-log'], static function () {
        Route::get('', [ActivityLogController::class, 'index']);
    });

    /*
     * LoginLog
     */
    Route::group(['prefix' => 'login-log'], static function () {
        Route::get('', [LoginLogController::class, 'index']);
    });

    /*
     * MailReceiverGroup
     */
    Route::group(['prefix' => 'mail-receiver-groups'], static function () {
        Route::get('', [MailReceiverGroupController::class, 'index']);
        Route::post('', [MailReceiverGroupController::class, 'store']);
        Route::get('{mailReceiverGroup}', [MailReceiverGroupController::class, 'show']);
        Route::put('{mailReceiverGroup}', [MailReceiverGroupController::class, 'update']);
        Route::delete('{mailReceiverGroup}', [MailReceiverGroupController::class, 'delete']);
    });

    /*
     * Mail
     */
    Route::group(['prefix' => 'mail'], static function () {
        Route::post('', [MailController::class, 'send']);
        Route::get('receiver-preview', [MailController::class, 'receiverPreview']);
    });

    /*
     * Asset
     */
    Route::group(['prefix' => 'assets'], static function () {
        Route::get('', [AssetController::class, 'index']);
        Route::post('{asset}', [AssetController::class, 'update']);
    });
});
