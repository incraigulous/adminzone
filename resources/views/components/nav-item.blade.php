<?php
    $href = $href ?? '';
    $path = trim(str_replace(url()->to('/'), '', $href), '/');
    $active = $active ?? request()->is($path);
    $class = $class ?? '';
    $linkClass = AZ::helpers()->classes(
        $linkClass ?? '', "nav-link", ($active) ? 'active' : ''
    );
    $dropdown = $dropdown ?? '';
    $attributes = $attributes ?? [
        'class' => AZ::helpers()->classes($class, "nav-item"),
    ];
?>


<li {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    @if($dropdown)
        <az-dropdown alignment="right">
    @endif
    @if ($href)
        <a class="{{ $linkClass }}" href="{{ $href }}">
            @endif
            {{ $slot }}
            @if($href)
        </a>
    @endif
    @if($dropdown)
            <slot name="menu">
                {{ $dropdown }}
            </slot>
        </az-dropdown>
    @endif
</li>
