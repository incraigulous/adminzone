<?php
    $class = $class ?? '';
    $themeColor = $themeColor ?? 'light';
    $textColor = $textColor ?? AZ::helpers()->textColorFromTheme($themeColor);
    $attributes = $attributes ?? [
        'class' => AZ::helpers()->classes("d-dlex", "navbar", "navbar-expand-lg", "navbar-{$themeColor }", "bg-{$themeColor}", $class, "text-{$textColor}"),
        'data-target' => $dataTarget ?? null
    ];
?>
<nav {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    @if(isset($left))
        <div class="flex-grow-0 d-flex">
            {{ $left }}
        </div>
    @endif
    <div class="flex-grow-1 d-flex">
        {{ $slot }}
    </div>
    @if(isset($right))
        <div class="flex-grow-0 d-flex">
            {{ $right }}
        </div>
    @endif
</nav>
