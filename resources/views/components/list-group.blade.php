<?php
$class = $class ?? '';
$flush = $flush ?? true;
$themeColor = $themeColor ?? 'white';
$textColor = $textColor ?? AZ::helpers()->textColorFromTheme($themeColor);
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes(
            'list-group',
            ($flush) ? 'list-group-flush' : '', $class,
            "bg-{$themeColor}",
            "text-{$textColor}"
        )
    ];
?>

<ul {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</ul>
