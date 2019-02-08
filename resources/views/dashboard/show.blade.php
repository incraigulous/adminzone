@extends('adminzone::layouts.layout')

@section('utility-nav')
    <az-navbar themeColor="white" class="utility-nav">
        <slot name="left">
            <h5 class="mb-0">Dashboard</h5>
        </slot>
    </az-navbar>
@endsection

@section('main')
    <div class="container-fluid">
        <div class="row">
            @foreach($resources as $resource)
                <div class="col-sm-6">
                    <az-card themeColor="white" class="mb-4 text-center">
                        <az-card-body>
                            <az-card-title>
                                Total {{ $resource->getCollectionLabel() }}
                            </az-card-title>
                            <h1>
                                {{ $resource->getRepository()->count() }}
                            </h1>
                        </az-card-body>
                    </az-card>
                </div>
            @endforeach
        </div>
        
    </div>
@endsection
