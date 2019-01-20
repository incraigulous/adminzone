<?php
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes("navbar-item", $class ?? '')
    ];
?>

<div {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</div>
