<?php
$active = $active ?? false;
$href = $href ?? null;
$class = $class ?? null;
$attributes = $attributes ?? [
        'href'        => $href,
        'class'       => AZ::helpers()->classes($class, "dropdown-item", ($active) ? 'active' : $active),
        'data-action' => $dataAction ?? null
    ];
?>

<a {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</a>
