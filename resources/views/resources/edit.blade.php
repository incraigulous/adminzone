@extends('adminzone::layouts.dashboard')

@section('title', 'Edit ' . $resource->getLabel() . " - " . $entry->label)

@section('utility-nav')
    <az-navbar themeColor="white" class="utility-nav">
        <slot name="left">
            <h5 class="mb-0">Edit {{ $resource->getLabel() }}</h5>
        </slot>
        <slot name="right">
            {{ Breadcrumbs::render($resource->getEditRoute(), compact('resource', 'entry')) }}
        </slot>
    </az-navbar>
@endsection

@section('main')
    <div class="container-fluid">
        <az-page-title>{{ $entry->label }}</az-page-title>
    
        @include(
            $resource->getEditForm()->getView(),
            [
                'form' => $resource->getEditForm(),
                'method' => 'PUT',
                'action' => route(
                    $resource->getUpdateRoute(),
                    ['slug' => $resource->getSlug(), 'id' => $entry->id]
                )
            ]
        )
    </div>
@endsection
