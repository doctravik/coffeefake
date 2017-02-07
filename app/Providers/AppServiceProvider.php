<?php

namespace App\Providers;

use App\Cart;
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
        \App\Product::observe(\App\Observers\ProductObserver::class);

        view()->composer(['app', 'cart.index', 'cart.index2', 'product.index'], function($view) {
            $cart = resolve(Cart::class);
            $view->with('cart', $cart);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Cart::class, function() {
            return (new Cart(new \App\Support\Storage\SessionStorage));
        });
    }
}
