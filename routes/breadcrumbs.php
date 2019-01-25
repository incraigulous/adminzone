<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

if (!Breadcrumbs::exists('adminzone::dashboard')) {
    Breadcrumbs::for('adminzone::dashboard', function ($trail) {
        $trail->push('Dashboard', route('adminzone::dashboard'));
    });
}

Breadcrumbs::for('adminzone::resource', function ($trail, $resource) {
    $trail->push('Dashboard', route('adminzone::dashboard'));
    $trail->push($resource->collectionLabel, route('adminzone::resource', $resource->slug));
});
