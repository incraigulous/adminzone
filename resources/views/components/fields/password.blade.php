<?php
$attributes['class'] = $attributes['class'] . ' ' . 'form-control';

unset($attributes['value'])
?>
<?php
    $confirmationAttributes = $confirmationAttributes ?? array_merge($attributes, [
        'name' => $attributes['name'] . '_confirmation',
        'placeholder' => 'confirm',
    ]);
?>
<az-form-group>
    @if($label)
        <slot name="label">
            {{  $label }}
        </slot>
    @endif
    
    <div class="w-100">
        <div class="row">
            <div class="col-sm-6">
                <input {!! AZ::helpers()->toHtmlAttributes($attributes); !!} type="password" autocomplete="new-password"  data-lpignore="true">
            </div>
            <div class="col-sm-6">
                <input {!! AZ::helpers()->toHtmlAttributes($confirmationAttributes); !!} type="password" autocomplete="new-password" data-lpignore="true">
            </div>
        </div>
    </div>
    {{ $slot }}
    <slot name="tip">
        <az-field-tip>{{ $error ?? '' }}</az-field-tip>
        <az-field-error name="{{ $validationName }}">{{ $error ?? '' }}</az-field-error>
    </slot>
</az-form-group>
