<?php
$alignment = $alignment ?? 'left';
$class = $class ?? '';
$menuClass = $menuClass ?? '';
$icon = $icon ?? true;
$attributes = $attributes ?? [
    'class' => AZ::helpers()->classes(
        "dropdown",
        $class
    )
];
$menuAttributes = $menuAttributes ?? [
        'class' => AZ::helpers()->classes(
            "dropdown-menu",
            'dropdown-menu-' . $alignment,
            $menuClass
        )
    ];
?>
<div {!! AZ::helpers()->toHtmlAttributes($attributes) !!} data-controller="dropdown">
    <div data-action="click->dropdown#toggle">
        {{ $slot }}
    </div>
    <div {!! AZ::helpers()->toHtmlAttributes($menuAttributes) !!} data-target="dropdown.menu">
        {{ $menu }}
    </div>
</div>
