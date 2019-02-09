<?php
$class = $class ?? '';
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('card-footer', $class)
    ];
?>

<div {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</div>
