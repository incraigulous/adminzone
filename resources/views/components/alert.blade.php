<?php
$class = $class ?? null;
$theme = $theme ?? 'info';
$href = $href ?? null;
$dataTarget = $dataTarget ?? null;
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('alert', $class, "alert-{$theme}", 'w-100'),
        'href' => $href,
        'role' => 'alert',
        'data-target' => $dataTarget
    ];
?>

<div {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</div>
