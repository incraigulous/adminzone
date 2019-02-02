@extends('adminzone::layouts.dashboard')

@section('main')
    <div class="container-fluid">
        <section class="search_results">
            <p>Your search: <b><i>{{ $query }}</i></b></p>
            @if(!$results->count())
                <az-alert theme="warning">No results found.</az-alert>
            @endif
            @foreach($results as $item)
                <az-card themeColor="light" class="mb-3">
                    <az-card-body>
                        <az-card-title>
                            {{ $item->resource->getCollectionLabel() }}
                        </az-card-title>
                        @foreach($item->results as $result)
                            <az-list-group>
                                <az-list-group-item>
                                    <h5><a href="{{ route($item->resource->getShowRoute(), ['slug' => $item->resource->getSlug(), 'id' => $result->id]) }}">{{ $result->label }}</a></h5>
                                    @if ($result->description)
                                        <small>{{ $result->description }}</small>
                                    @endif
                                </az-list-group-item>
                            </az-list-group>
                        @endforeach
                    </az-card-body>
                </az-card>
            @endforeach
        </section>
    </div>
@endsection
