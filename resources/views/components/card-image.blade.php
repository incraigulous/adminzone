<?php
$class = $class ?? '';
$placement = $placement ?? "top";
$src = $src ?? '';
$alt = $alt ?? '';
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes('card-img-' . $placement , $class),
        'src' => $src,
        'alt' => $alt
    ];
?>

<img {!! AZ::helpers()->toHtmlAttributes($attributes) !!} />
{{ $slot }}
