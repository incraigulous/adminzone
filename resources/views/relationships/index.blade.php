@extends('adminzone::layouts.dashboard')

@section('main')
    <div class="container-fluid" data-controller="entry-select" data-entry-select-slug="{{ $resource->getSlug() }}" data-entry-select-ctx="{{ request()->header('x-ctx') }}">
        <form>
            <input type="text" class="form-control mb-3" value="{{ request()->get('q') }}" data-target="entry-select.field" placeholder="Search..." data-action="change->entry-select#search">
        </form>
        
        @foreach($entries as $entry)
            <az-card class="mb-3">
                <az-card-body class="py-2">
                        <div class="d-flex">
                            <div class="flex-grow-0">
                                <az-button theme="secondary" data-action="click->entry-select#select" :data-id="$entry->id">Select</az-button>
                            </div>
                            <div class="flex-grow-1 pl-3">
                                <div>
                                    <b>{{ $entry->label }}</b>
                                </div>
                                @if($entry->description)
                                    <div class="small text-secondary">
                                        {{ $entry->description }}
                                    </div>
                                @endif
                            </div>
                        </div>
                </az-card-body>
            </az-card>
        @endforeach
        
        <div data-target="entry-select.pagination">
            {!! $entries->links() !!}
        </div>
    </div>
@endsection
