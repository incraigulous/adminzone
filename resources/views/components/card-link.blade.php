<?php
$class = $class ?? '';
$href = $href ?? '';
$textColor = $textColor ?? 'dark';
$attributes = $attributes ?? [
    'href' => $href,
    'class' => AZ::helpers()->classes('card-link', $class, "text-{$textColor}")
];
?>

<a {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</a>
