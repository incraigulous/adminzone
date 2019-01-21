<?php
use Illuminate\Support\Facades\Route;
use Incraigulous\AdminZone\AdminZone;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Route::middleware(['web', config('adminzone.middleware')])
    ->namespace('Incraigulous\AdminZone\Controllers')
    ->group(function() {
        Route::prefix(config('adminzone.path'))->group(function() {
            Route::get('/', 'DashboardController@show')->name('adminzone::dashboard');
        });

        AdminZone::getItems()->each(function($resource) {
            Route::get($resource->path(), 'DashboardController@show')->name($resource->route());
        });
    });

if (!Breadcrumbs::exists('adminzone::dashboard')) {
    Breadcrumbs::for('adminzone::dashboard', function ($trail) {
        $trail->push('Dashboard', route('adminzone::dashboard'));
    });
}

AdminZone::getItems()->each(function($resource) {
    if (!Breadcrumbs::exists($resource->route())) {
        Breadcrumbs::for($resource->route(), function ($trail) use ($resource) {
            $trail->push('Dashboard', route('adminzone::dashboard'));
            $trail->push($resource->label(), route($resource->route()));
        });
    }
});
