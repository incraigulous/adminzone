<?php
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
    <az-card class="w-100">
        <az-card-body>
            THis is a test
        </az-card-body>
    </az-card>
    {{ $slot }}
    <slot name="tip">
        <az-field-tip>{{ $error ?? '' }}</az-field-tip>
        <az-field-error name="{{ $validationName }}">{{ $error ?? '' }}</az-field-error>
    </slot>
</az-form-group>
