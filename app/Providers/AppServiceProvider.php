<?php

namespace App\Providers;

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
        $this->loadAssets();
    }

    public function loadAssets()
    {
        $assets = config('theme');

        view()->share('cssFiles', $assets['css']);
        view()->share('jsFiles', $assets['js']);
    }
}
