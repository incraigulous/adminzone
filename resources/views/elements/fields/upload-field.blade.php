@component('adminzone::components.fields.upload', $attributes)
    @slot('label')
        {{ $label }}
    @endslot
    
    @if (isset($entry))
        <div class="mt-3">
            @include('adminzone::assets.show', ['asset' => $entry])
        </div>
    @endif
@endcomponent
