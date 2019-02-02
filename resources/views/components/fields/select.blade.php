<?php
    $attributes['class'] = $attributes['class'] . ' ' . 'custom-select';
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
    <select {!! AZ::helpers()->toHtmlAttributes($attributes); !!}>
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
       {{ $slot }}
    </select>
    
    <slot name="tip">
        <az-field-tip>{{ $error ?? '' }}</az-field-tip>
        <az-field-error name="{{ $validationName }}">{{ $error ?? '' }}</az-field-error>
    </slot>
</az-form-group>
