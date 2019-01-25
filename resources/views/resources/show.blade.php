@extends('adminzone::layouts.layout')

@section('utility-nav')
    <az-navbar themeColor="white" class="utility-nav">
        <slot name="left">
            <h5 class="mb-0">{{ $resource->collectionLabel }}</h5>
        </slot>
        <slot name="right">
            {{ Breadcrumbs::render($resource->route, $resource) }}
        </slot>
    </az-navbar>
@endsection

@section('main')
    <div class="container-fluid">
        <az-card themeColor="white" class="p-4">
            <az-table>
                <slot name="head">
                    @foreach($resource->columns->toArray() as $label => $field)
                        <th scope="col">{{ ucfirst($label) }}</th>
                    @endforeach
                </slot>
                @foreach($resource->repository->paginate() as $item)
                        <tr>
                            @foreach($resource->columns->toArray() as $label => $field)
                                @if($loop->first)
                                    <th scope="row">{{ $item->$field }}</th>
                                @else
                                    <td>{{ $item->$field }}</td>
                                @endif
                            @endforeach
                        </tr>
                @endforeach
                
            </az-table>
        </az-card>
    </div>
@endsection
