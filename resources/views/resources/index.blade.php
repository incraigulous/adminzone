@extends('adminzone::layouts.layout')

@section('utility-nav')
    <az-navbar themeColor="white" class="utility-nav">
        <slot name="left">
            <h5 class="mb-0">{{ $resource->getCollectionLabel() }}</h5>
        </slot>
        <slot name="right">
            {{ Breadcrumbs::render($resource->getRoute(), $resource) }}
        </slot>
    </az-navbar>
@endsection

@section('main')
    <div class="container-fluid">
        <div class="mt-2 d-flex mx-3 text-center">
            <div class="flex-grow-1 m-2">
                <form action="{{ route($resource->getRoute(), ['slug' => $resource->getSlug()]) }}" method="GET" class="d-flex">
                    <div class="flex-grow-1">
                        <az-field-text placeholder="Filter" name="q" class="mr-3" :value="request()->get('q')"></az-field-text>
                    </div>
                    <div class="flex-grow-0">
                        <az-button type="submit">Filter</az-button>
                    </div>
                </form>
            </div>
            <div class="flex-grow-0 m-2">
                {{ $items->links() }}
            </div>
            <div class="flex-grow-0 m-2">
                <az-button element="a" :href="route($resource->getCreateRoute(), ['slug' => $resource->getSlug()])">Create {{ $resource->getLabel() }}</az-button>
            </div>
        </div>
        <az-card themeColor="white" class="p-4">
            <az-table>
                <slot name="head">
                    @foreach($resource->getColumns() as $label => $field)
                        <th scope="col">{{ ucfirst($label) }}</th>
                    @endforeach
                    <th scope="col"></th>
                </slot>
                @foreach($items as $item)
                        <tr>
                            @foreach($resource->getColumns() as $label => $field)
                                @if($loop->first)
                                    <th scope="row">{{ $item->$field }}</th>
                                @else
                                    <td>
                                        {!! AZ::helpers()->callbackOr(function($field, $item) {
                                            return $item->$field;
                                        }, $field, $item) !!}
                                    </td>
                                @endif
                            @endforeach
                            <td>
                                <div class="btn-group float-right dropdown" role="group" data-controller="dropdown">
                                    <az-button size="sm" theme="primary" element="a" :href="route($resource->getShowRoute(), ['slug' => $resource->getSlug(), 'id' => $item->id])"><az-icon name="eye"></az-icon></az-button>
                                    <az-button size="sm" theme="secondary" element="a" :href="route($resource->getEditRoute(), ['slug' => $resource->getSlug(), 'id' => $item->id])"><az-icon name="edit"></az-icon></az-button>
                                    <az-button size="sm" theme="dark" data-action="click->dropdown#toggle">
                                        <az-icon name="ellipsis-h"></az-icon>
                                    </az-button>
                                    <div class="dropdown-menu dropdown-menu-right" data-target="dropdown.menu">
                                            <az-form-link method="DELETE" :href="route($resource->getDestroyRoute(), ['slug' => $resource->getSlug(), 'id' => $item->id])">
                                                <az-dropdown-item>
                                                Delete
                                                </az-dropdown-item>
                                            </az-form-link>
                                    </div>
                                    <div class="dropdown-backdrop" data-target="dropdown.backdrop" data-action="click->dropdown#close"></div>
                                </div>
                            </td>
                        </tr>
                @endforeach
            </az-table>
    </az-card>
    <div class="mt-2 d-flex mx-3">
        <div class="flex-grow-1 mx-2"></div>
        <div class="flex-grow-0 mx-2">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection
