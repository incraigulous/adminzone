<az-form-group>
    @if($label)
        <slot name="label">
            {{  $label }}
        </slot>
    @endif
    @if($prepend)
        <slot name="prepend">
            {{ $prepend }}
        </slot>
    @endif
    <text-area {!! AZ::helpers()->toHtmlAttributes($attributes); !!}>
        {{ $value }}
    </text-area>
    {{ $slot }}
    <slot name="tip">
        <az-field-tip>{{ $error ?? '' }}</az-field-tip>
        <az-field-error name="{{ $validationName }}">{{ $error ?? '' }}</az-field-error>
    </slot>
</az-form-group>
