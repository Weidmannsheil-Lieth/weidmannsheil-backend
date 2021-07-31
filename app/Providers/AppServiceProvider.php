<?php

namespace App\Providers;

use App\Models\Administration;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use App\Models\News;
use App\Models\Notice;
use App\Models\Result;
use App\Models\Rout;
use App\Observers\ActivityObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        GalleryAlbum::observe(ActivityObserver::class);
        GalleryImage::observe(ActivityObserver::class);
        News::observe(ActivityObserver::class);
        Notice::observe(ActivityObserver::class);
        Result::observe(ActivityObserver::class);
        Rout::observe(ActivityObserver::class);
        Administration::observe(ActivityObserver::class);
    }
}
