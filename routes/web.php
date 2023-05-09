<?php

use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    Route::group(['middleware' => ['guest']], function() {
        Route::get('/register', 'RegisterController@show')->name('register');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        Route::get('/login', 'LoginController@show')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', 'HomeController@index')->name('home.index');
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

        Route::resource('timesheets', TimesheetController::class);

        Route::controller(TimesheetController::class)->prefix('timesheet-management')->name('timesheet-management.')->group(function () {
            Route::get('/', 'list')->name('list');
            Route::get('/{timesheet}', 'show')->whereNumber('timesheet')->name('show');
            Route::get('/export', 'export')->name('export');
            Route::put('/{timesheet}/approve', 'approve')->whereNumber('timesheet')->name('approve');
        });

        Route::resource('users', UserController::class)->middleware('can:manage-users');        
    });
});
