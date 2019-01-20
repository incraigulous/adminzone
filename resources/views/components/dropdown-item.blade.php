<?php
$active = $active ?? false;
$href = $href ?? '';
$class = $class ?? '';
$attributes = $attributes ?? [
    'href' => $href,
    'class' => AZ::helpers()->classes($class, "dropdown-item", ($active) ? 'active' : $active),
];
?>

<a {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
   {{ $slot }}
</a>
