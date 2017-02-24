<?php

namespace App\Providers;

use App\Cart;
use Illuminate\Support\Facades\Route;
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

        view()->composer('*', function($view) {
            $cart = resolve(Cart::class);
            $view->with('cart', $cart);
        });

        view()->composer([
                'layouts.nav',
                'layouts.auth',
                'dashboard.menu',
                'order.partials.menu', 
                'auth.partials.menu'
            ], function($view) {
            $view->with('route', Route::currentRouteName());
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

        $this->app->bind(\App\Billing\PaymentGateway::class, function() {
            return new \App\Billing\StripePaymentGateway(config('services.stripe.secret'));
        });
    }
}
