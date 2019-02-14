<?php
$class = $class ?? '';
$themeColor = $themeColor ?? 'white';
$textColor = $textColor ?? AZ::helpers()->textColorFromTheme($themeColor);
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('form-group', $class, "bg-$themeColor", "text-$textColor", "form-group-horizontal")
    ];
$label = $label ?? '';
$before = $before ?? '';
$after = $after ?? '';
$tip = $tip ?? '';
?>

<div {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    <div class="row">
        @if($label)
        <div class="col-sm-3 d-flex align-content-center justify-content-sm-end align-items-right">
            <label class="mb-0 font-weight-bold">{{ $label }}</label>
        </div>
        @endif
        <div class="col-sm">
            <az-input-group>
                @if($before)
                    <slot name="before">
                        {{ $before }}
                    </slot>
                @endif
                {{ $slot }}
                @if($after)
                    <slot name="after">
                        {{ $after }}
                    </slot>
                @endif
            </az-input-group>
    
            <az-field-tip>
                {{ $tip }}
            </az-field-tip>
        </div>
    </div>
</div>
