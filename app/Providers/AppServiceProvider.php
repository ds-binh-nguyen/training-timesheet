<?php

namespace App\Providers;

use App\Services\Interfaces\TimesheetServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\TimesheetService;
use App\Services\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        TimesheetServiceInterface::class => TimesheetService::class,
        UserServiceInterface::class => UserService::class,
    ];

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
        Paginator::useBootstrap();
    }
}
