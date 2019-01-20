<?php
$element = $element ?? 'h5';
$class = $class ?? '';
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('card-title', $class)
    ];
?>

<{{ $element }} {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</{{ $element }}>
