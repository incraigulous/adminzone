<?php
$class = $class ?? '';
$size = $size ?? '';
$attributes = $attributes ?? [
    'class' => AZ::helpers()->classes('input-group', $class, ($size) ? "input-group-{$size}" : '')
];
$before = $before ?? '';
$after = $after ?? '';
?>

<div {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    @if($before)
        <div class="input-group-prepend">
            {{ $before }}
        </div>
    @endif
    {{ $slot }}
    @if($after)
        <div class="input-group-append">
            {{ $after }}
        </div>
    @endif
</div>
