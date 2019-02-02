<?php
    $class = $class ?? '';
    $themeColor = $themeColor ?? 'white';
    $attributes = $attributes ?? [
        'class' => AZ::helpers()->classes("sidebar", $class, 'bg-' . $themeColor),
        'data-target' => $dataTarget ?? null
    ];
?>
<aside {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</aside>
