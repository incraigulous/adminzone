<?php
    $attributes = $attributes ?? [
        'class' => AZ::helpers()->classes("nav", $class ?? '')
    ];
?>

<ul {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    {{ $slot }}
</ul>
