<?php
$class = $class ?? '';
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('card-header', $class)
    ];
?>

<div {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
{{ $slot }}
</div>
