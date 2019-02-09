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
        <div class="p-5">
            <div class="row">
                @foreach($resources as $resource)
                    <div class="col-sm-6">
                        <az-card themeColor="white" class="mb-4 text-center">
                            <az-card-header class="text-uppercase font-weight-bolder text-secondary">
                                Total {{ $resource->getCollectionLabel() }}
                            </az-card-header>
                            <az-card-body class="lead">
                                <h1 class="text-primary">
                                    {{ $resource->getRepository()->count() }}
                                </h1>
                            </az-card-body>
                            <az-card-footer>
                                <a class="btn btn-secondary btn-block" href="{{ $resource->getPath() }}">
                                    Go to {{ $resource->getCollectionLabel() }}
                                </a>
                            </az-card-footer>
                        </az-card>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>
@endsection
