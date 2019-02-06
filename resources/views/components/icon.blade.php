<?php
$class = $class ?? '';
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('icon', 'fa', "fa-{$name}", $class)
    ];
?>

<span {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</span>
