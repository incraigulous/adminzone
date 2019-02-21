<?php
$class = $class ?? '';
$themeColor = $themeColor ?? 'white';
$textColor = $textColor ?? AZ::helpers()->textColorFromTheme($themeColor);
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes(
            $class,
            'list-group-item',
            "bg-{$themeColor}",
            "text-{$textColor}"
            )
    ];
?>


<li {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>{{ $slot }}</li>
