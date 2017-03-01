<?php

namespace App\Providers;

use App\Cart;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (env('APP_ENV') === 'production') {
            $url->forceSchema('https');
        }
        
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
        
        $this->app->bind('App\Queries\UpdateProductStock', function () {
            return new \App\Queries\UpdateProductStockPostgres();
        });
    }
}
