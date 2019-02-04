<?php
use Illuminate\Support\Facades\Route;


Route::middleware(['web', config('adminzone.middleware')])
    ->namespace('Incraigulous\AdminZone\Controllers')
    ->group(function() {
        Route::prefix(config('adminzone.path'))->group(function() {
            Route::get('/', 'DashboardController@show')->name('adminzone::dashboard');
            Route::get('/search','SearchController@index')->name('adminzone::search');
            Route::get('resources/{slug}', 'ResourceController@index')->name('adminzone::resource');
            Route::get('resources/{slug}/{id}/edit', 'ResourceController@edit')->name('adminzone::resource.edit');
            Route::delete('resources/{slug}/{id}', 'ResourceController@destroy')->name('adminzone::resource.destroy');
            Route::put('resources/{slug}/{id}', 'ResourceController@update')->name('adminzone::resource.update');
            Route::get('resources/{slug}/create', 'ResourceController@create')->name('adminzone::resource.create');
            Route::post('resources/{slug}', 'ResourceController@store')->name('adminzone::resource.store');
            Route::get('resources/{slug}/select', 'ResourceController@select')->name('adminzone::resource.select');
            Route::get('resources/{slug}/{id}', 'ResourceController@show')->name('adminzone::resource.show');
        });
    });
