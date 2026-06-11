<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            $cartCount = Auth::check()
                ? Cart::where('user_id', Auth::id())->count()
                : 0;
            $allOrders = Order::count();
            $pendingOrders = Order::where(
                'status',
                'pending'
            )->count();

            $waitingVerification = Order::where(
                'status',
                'waiting_verification'
            )->count();

            $processingOrders = Order::where(
                'status',
                'processing'
            )->count();

            $view->with([
            'cartCount'           => $cartCount,
            'allOrders'           => $allOrders,
            'pendingOrders'       => $pendingOrders,
            'waitingVerification' => $waitingVerification,
            'processingOrders'    => $processingOrders,
        ]);
        });
    }
}