<?php
$class = $class ?? '';
$attributes = $attributes ?? [
    'class' => AZ::helpers()->classes('card-body', $class)
];
?>

<div {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</div>
