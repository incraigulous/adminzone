<?php
$class = $class ?? '';
$imageTop = $image ?? '';
$themeColor = $themeColor ?? 'white';
$textColor = $textColor ?? AZ::helpers()->textColorFromTheme($themeColor);
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('card', $class, "bg-{$themeColor}", "text-{$textColor}")
    ];
?>
<div {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
   {{ $slot }}
</div>
