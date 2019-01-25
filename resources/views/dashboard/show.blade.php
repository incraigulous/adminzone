@extends('adminzone::layouts.layout')

@section('utility-nav')
    <az-navbar themeColor="white" class="utility-nav">
        <slot name="left">
            <h5 class="mb-0">{{ $resource->labelPlurual }}</h5>
        </slot>
        <slot name="right">
            {{ Breadcrumbs::render($resource->route, $resource) }}
        </slot>
    </az-navbar>
@endsection
@section('main')
    <div class="container-fluid">
        <az-card themeColor="white">
            <az-chart></az-chart>
        </az-card>
    </div>
@endsection
