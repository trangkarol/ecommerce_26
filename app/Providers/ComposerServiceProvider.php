<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', 'App\Http\ViewComposers\MenuComposer');
        view()->composer('*', 'App\Http\ViewComposers\ProductNewsComposer');
        view()->composer('*', 'App\Http\ViewComposers\CartComposer');
        view()->composer('*', 'App\Http\ViewComposers\ViewedProductComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       //
    }
}
