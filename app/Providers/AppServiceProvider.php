<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\OnlineCart;
use App\Models\UserCart;
use Auth;

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
        view()->composer('*', function($view){
            if(Auth::check()){
                $usercart = UserCart::orderBy('id', 'DESC')->where('user_id', Auth::user()->id)->get();
                $totalQuantity = 0;
                $totalPrice = 0;
                foreach($usercart as $item){
                   $totalQuantity += $item->quantity; 
                   $totalPrice += ($item->quantity*$item->price);
                } 
                $view->with(compact('usercart', 'totalQuantity', 'totalPrice'));
            }
            else{
                $onlinecart = new OnlineCart();
                $view->with(compact('onlinecart'));
            }
        });
    }
}
