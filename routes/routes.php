<?php
Route::middleware(['web', config('adminzone.middleware')])
    ->namespace('Incraigulous\AdminZone\Controllers')
    ->group(function() {
        Route::prefix(config('adminzone.path'))->group(function() {
            Route::get('/', 'DashboardController@show')->name('adminzone::dashboard');
        });

        AZ::toObject()->each(function($resource) {
            Route::get($resource->path, 'DashboardController@show')->name($resource->route);
        });
    });

Breadcrumbs::for('adminzone::dashboard', function ($trail) {
    $trail->push('Dashboard', route('adminzone::dashboard'));
});

AZ::toObject()->each(function($resource) {
    Breadcrumbs::for($resource->route, function ($trail) use ($resource) {
            $trail->push('Dashboard', route('adminzone::dashboard'));
            $trail->push($resource->label, route($resource->route));
    });
});
