@extends('adminzone::layouts.dashboard')

@section('title', 'Create ' . $resource->getLabel())

@section('utility-nav')
    <az-navbar themeColor="white" class="utility-nav">
        <slot name="left">
            <h5 class="mb-0">Create {{ $resource->getLabel() }}</h5>
        </slot>
        <slot name="right">
            {{ Breadcrumbs::render($resource->getCreateRoute(), compact('resource')) }}
        </slot>
    </az-navbar>
@endsection

@section('main')
    <div class="container-fluid">
        <az-page-title>New {{ $resource->getLabel() }}</az-page-title>
    
        @include(
            $resource->getEditForm()->getView(),
            [
                'form' => $resource->getEditForm(),
                'method' => 'POST',
                'action' => route(
                    $resource->getStoreRoute(),
                    ['slug' => $resource->getSlug()]
                )
            ]
        )
    </div>
@endsection
