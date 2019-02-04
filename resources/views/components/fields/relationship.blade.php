<az-form-group>
    <div data-controller="relationship" data-relationship-slug="asset">
        @if($label)
            <slot name="label">
                {{  $label }}
            </slot>
        @endif
        @if($before)
            <slot name="prepend">
                {{ $before }}
            </slot>
        @endif
        <az-card class="w-100">
            <az-card-body>
                @if(!$value)
                    <az-button theme="secondary" data-action="click->relationship#openNew">Create New</az-button>
                    <az-button theme="secondary" data-action="click->relationship#openExisting">Choose Existing</az-button>
                @else
            
                @endif
            </az-card-body>
        </az-card>
        {{ $slot }}
        <slot name="tip">
            <az-field-tip>{{ $error ?? '' }}</az-field-tip>
            <az-field-error name="{{ $validationName }}">{{ $error ?? '' }}</az-field-error>
        </slot>
    </div>
</az-form-group>
