{{--
BUTTON
------

ATTRS:
- $element: The DOM element type. (button | a)
- $class: CSS class(es)
- $target: _self or _blank
- $linkUrl: What should the button link to?
- $label: The button label
- $context: The bootstrap context.
- $icon: The icomoon icon to use in the button to the right of the label. Example: chevron-right.
- $iconLeft: The icomoon icon to appear to the left of the label. Example: chevron-left.
--}}
<?php
$title = $title ?? null;
$href = $href ?? null;
$size = $size ?? null;
$theme = $theme ?? 'primary';
$element = $element ?? 'button';
$type = $type ?? null;
$role = null;
if ($element === 'button') {
    $type = $type ?? 'button';
} else {
    $role = $role ?? 'button';
}
$dataAction = $dataAction ?? null;
$buttonAttributes = [
    'type'   => $type,
    'role' => $role,
    'class'  => AZ::helpers()->classes(
        'btn',
        'btn-' . $theme,
        ($size) ? 'btn-' . $size : null,
        $class ?? ''),
    'id' => $id ?? null,
    'href' => $href,
    'title' => $title,
    'data-action' => $dataAction,
    'data-target' => $dataTarget ?? null
];

?>

<{{ $element }} {!! AZ::helpers()->toHtmlAttributes($buttonAttributes) !!}>

{{ $slot }}

</{{ $element }}>
