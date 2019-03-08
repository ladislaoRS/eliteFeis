<?php

namespace App\Providers;

use App\Tag;
use App\Post;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        // \View::composer('*', function ($view) {
        //     $tags = \Cache::rememberForever('tags', function(){
        //         return Tag::all();
        //     });
        //     $view->with('tags', $tags);
        // });
        \View::composer(['posts.index', 'posts.show'], function ($view) {
            $tags = Tag::all();
            $view->with('tags', $tags);
        });
        
         \View::composer(['posts.index', 'posts.show'], function ($view) {
            $view->with('popularity', Post::take(4)->orderBy('replies_count', 'desc')->get());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->isLocal())
        {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
        
        // Force SSL in production
        if ($this->app->environment() == 'production') {
            URL::forceScheme('https');
        }
    }
}
