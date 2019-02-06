<?php
    $attributes['class'] = $attributes['class'] . ' ' . 'form-control';
?>
<az-form-group>
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
    
    <input {!! AZ::helpers()->toHtmlAttributes($attributes); !!} type="email" value="{{ $value }}" autocomplete="off" data-lpignore="true">
    {{ $slot }}
    <slot name="tip">
        <az-field-tip>{{ $error ?? '' }}</az-field-tip>
        <az-field-error name="{{ $validationName }}">{{ $error ?? '' }}</az-field-error>
    </slot>
</az-form-group>
