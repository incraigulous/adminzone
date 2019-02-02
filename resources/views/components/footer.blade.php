<?php
$class = $class ?? '';
$bg = $bg ?? 'white';
$attributes = $attributes ?? [
        'class' => AZ::helpers()->classes("footer", $class, 'bg-' . $bg),
        'data-target' => $dataTarget ?? null
    ];
?>
<footer {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    <div class="container-fluid">
        {{ $slot }}
    </div>
</footer>
