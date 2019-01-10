<?php

Route::prefix(config('adminzone.path'))
    ->middleware(['web', config('adminzone.middleware')])
    ->namespace('Incraigulous\AdminZone\Controllers')
    ->group(function() {
        Route::get('/', 'DashboardController@show')->name('adminzone::dashboard');
    }
);
