<?php
$class = $class ?? '';
$href = $href ?? null;
$element = ($href) ? 'a' : 'div';


$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('card-header', $class),
        'href' => $href
    ];
?>

<{{ $element }} {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
{{ $slot }}
</{{ $element }}>
