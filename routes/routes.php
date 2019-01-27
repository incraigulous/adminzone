<?php
use Illuminate\Support\Facades\Route;


Route::middleware(['web', config('adminzone.middleware')])
    ->namespace('Incraigulous\AdminZone\Controllers')
    ->group(function() {
        Route::prefix(config('adminzone.path'))->group(function() {
            Route::get('/', 'DashboardController@show')->name('adminzone::dashboard');
            Route::get('/search','SearchController@index')->name('adminzone::search');
            Route::get('resources/{slug}', 'ResourceController@index')->name('adminzone::resource');
        });
    });
