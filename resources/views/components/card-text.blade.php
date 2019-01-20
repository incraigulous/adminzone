<?php
$element = $element ?? 'p';
$class = $class ?? '';
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('card-text', $class)
    ];
?>

<{{ $element }} {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</{{ $element }}>
