<?php

namespace App\Providers;

use App\Repositories\IRepository\TaskRepository;
use App\Repositories\IRepository\TimesheetRepository;
use App\Repositories\TaskRepositoryEloquent;
use App\Repositories\TimesheetRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    public $bindings = [
        TimesheetRepository::class => TimesheetRepositoryEloquent::class,
        TaskRepository::class => TaskRepositoryEloquent::class,
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
        //
    }
}
