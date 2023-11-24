<?php
//
//namespace App\Providers\AppServiceProvider;
//namespace Illuminate\Pagination\Paginator;
//use Illuminate\Support\ServiceProvider;
//use Nette\Utils\Paginator;
//
//class AppServiceProvider extends ServiceProvider
//{
//    /**
//     * Register any application services.
//     */
//    public function register(): void
//    {
//        //
//    }
//
//    /**
//     * Bootstrap any application services.
//     */
//    public function boot(): void
//    {
//        Paginator::useBootstrap();
//    }
//}


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();

    }
}
