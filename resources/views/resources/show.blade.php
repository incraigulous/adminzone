@extends('adminzone::layouts.dashboard')

@section('utility-nav')
    <az-navbar themeColor="white" class="utility-nav">
        <slot name="left">
            <h5 class="mb-0">{{ $resource->getLabel() }}</h5>
        </slot>
        <slot name="right">
            {{ Breadcrumbs::render($resource->getShowRoute(), compact('resource', 'entry')) }}
        </slot>
    </az-navbar>
@endsection

@section('main')
    <div class="container-fluid">
    
        <div class="mt-2 d-flex mx-3">
            <div class="flex-grow-1 mx-2"><az-page-title>{{ $entry->label }}</az-page-title></div>
            <div class="flex-grow-0 mx-2">
                @if($resource->canCreate())
                    <az-button element="a" :href="route($resource->getCreateRoute(), ['slug' => $resource->getSlug()])" class="mt-4" theme="secondary">New {{ $resource->getLabel() }}</az-button>
                @endif
                <az-button element="a" :href="route($resource->getEditRoute(), ['slug' => $resource->getSlug(), 'id' => $entry->id])" class="mt-4">Edit {{ $entry->label }}</az-button>
            </div>
        </div>
        <az-card>
            <az-card-body>
                <az-table>
                    <slot name="head">
                        <th scope="col" class="text-right">Field</th>
                        <th scope="col" width="100%" class="pl-4">Value</th>
                    </slot>
                    @foreach($resource->getFields() as $label => $field)
                        <tr>
                            <th scope="row" class="no-wrap text-right">{{ $label }}</th>
                            <td class="pl-4">
                                @include('adminzone::resources.includes.field', compact('field', 'entry'))
                            </td>
                        </tr>
                    @endforeach
                </az-table>
            </az-card-body>
        </az-card>
        <div class="text-right mx-3">
            <az-form-link method="DELETE" :href="route($resource->getDestroyRoute(), ['slug' => $resource->getSlug(), 'id' => $entry->id])">
                <az-button class="mt-3" size="sm" theme="danger">Delete {{ $entry->label }}</az-button>
            </az-form-link>
        </div>
    </div>
@endsection
