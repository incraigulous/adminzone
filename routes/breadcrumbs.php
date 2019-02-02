<?php
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

if (!Breadcrumbs::exists('adminzone::dashboard')) {
    Breadcrumbs::for('adminzone::dashboard', function ($trail) {
        $trail->push('Dashboard', route('adminzone::dashboard'));
    });
}

Breadcrumbs::for('adminzone::resource', function ($trail, $resource) {
    $trail->push('Dashboard', route('adminzone::dashboard'));
    $trail->push($resource->getCollectionLabel(), route('adminzone::resource', $resource->getSlug()));
});

Breadcrumbs::for('adminzone::resource.show', function ($trail, $params) {
    $trail->push('Dashboard', route('adminzone::dashboard'));
    $trail->push($params['resource']->getCollectionLabel(), route('adminzone::resource', $params['resource']->getSlug()));
    $trail->push($params['entry']->label, route('adminzone::resource.show', ['slug' => $params['resource']->getSlug(), 'id' => $params['entry']->id]));
});

Breadcrumbs::for('adminzone::resource.edit', function ($trail, $params) {
    $trail->push('Dashboard', route('adminzone::dashboard'));
    $trail->push($params['resource']->getCollectionLabel(), route('adminzone::resource', $params['resource']->getSlug()));
    $trail->push($params['entry']->label, route('adminzone::resource.edit', ['slug' => $params['resource']->getSlug(), 'id' => $params['entry']->id]));
});

Breadcrumbs::for('adminzone::resource.create', function ($trail, $params) {
    $trail->push('Dashboard', route('adminzone::dashboard'));
    $trail->push('Create ' . $params['resource']->getLabel(), route('adminzone::resource.create', ['slug' => $params['resource']->getSlug()]));
});
