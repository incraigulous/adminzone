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
        <div class="mt-2">
            {{ $items->links() }}
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
                                <div class="btn-group float-right" role="group" data-controller="dropdown">
                                    <az-button size="sm" theme="primary" element="a"><az-icon name="eye"></az-icon></az-button>
                                    <az-button size="sm" theme="secondary" element="a"><az-icon name="edit"></az-icon></az-button>
                                    <az-button size="sm" theme="dark" data-action="click->dropdown#toggle">
                                        <az-icon name="ellipsis-h"></az-icon>
                                    </az-button>
                                    <div class="dropdown-menu dropdown-menu-right" data-target="dropdown.menu">
                                        <az-dropdown-item>Delete</az-dropdown-item>
                                    </div>
                                </div>
                            </td>
                        </tr>
                @endforeach
            </az-table>
    </az-card>
    <div class="mb-2 mt-3">
        {{ $items->links() }}
    </div>
</div>
@endsection
