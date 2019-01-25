<?php
use Illuminate\Support\Facades\Route;


Route::middleware(['web', config('adminzone.middleware')])
    ->namespace('Incraigulous\AdminZone\Controllers')
    ->group(function() {
        Route::prefix(config('adminzone.path'))->group(function() {
            Route::get('/', 'DashboardController@show')->name('adminzone::dashboard');
            Route::get('resources/{slug}', 'ResourceController@show')->name('adminzone::resource');
        });
    });
