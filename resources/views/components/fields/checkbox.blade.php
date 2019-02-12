<?php
$attributes['class'] = $attributes['class'] . ' ' . 'form-check-input';
$attributes['type'] = 'checkbox';

$checked = $value ? true : false;
?>
<az-form-group>
    @if($before)
        <slot name="prepend">
            {{ $before }}
        </slot>
    @endif
    <div class="form-check pt-2">
        <input {!! AZ::helpers()->toHtmlAttributes($attributes); !!} @if($checked) checked @endif>
    
        @if($label)
            <slot name="label">
                {{  $label }}
            </slot>
        @endif
    </div>
    
    {{ $slot }}
    <slot name="tip">
        <az-field-tip>{{ $error ?? '' }}</az-field-tip>
        <az-field-error name="{{ $validationName }}">{{ $error ?? '' }}</az-field-error>
    </slot>
</az-form-group>
