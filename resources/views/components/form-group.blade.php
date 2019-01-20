<?php
$class = $class ?? '';
$themeColor = $themeColor ?? 'white';
$textColor = $textColor ?? AZ::helpers()->textColorFromTheme($themeColor);
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('form-group', $class, "bg-{$themeColor}", "text-{$textColor}")
    ];
$label = $label ?? '';
$before = $before ?? '';
$after = $after ?? '';
$tip = $tip ?? '';
?>

<div {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    <label>{{ $label }}</label>
    
    <az-input-group>
        @if($before)
            <slot name="before">
                {{ $prepend }}
            </slot>
        @endif
        {{ $slot }}
        @if($before)
            <slot name="after">
                {{ $after }}
            </slot>
        @endif
    </az-input-group>
    
   <az-field-tip>
       {{ $tip }}
   </az-field-tip>
</div>
