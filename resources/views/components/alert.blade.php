<?php
$class = $class ?? null;
$theme = $theme ?? 'info';
$href = $href ?? null;
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('alert', $class, "alert-{$theme}", 'd-block'),
        'href' => $href,
        'role' => 'alert'
    ];
?>

<a {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</a>
