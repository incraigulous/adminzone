<?php
$class = $class ?? '';
$href = $href ?? null;
$element = ($href) ? 'a' : 'div';
$backgroundColor = isset($backgroundColor) ? 'bg-' . $backgroundColor : null;

$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('card-header', $class, $backgroundColor),
        'href' => $href
    ];
?>

<{{ $element }} {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
{{ $slot }}
</{{ $element }}>
