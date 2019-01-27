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
$title = $title ?? '';
$href = $href ?? '';
$size = $size ?? '';
$theme = $theme ?? 'primary';
$element = $element ?? 'button';
$type = '';
$role = '';
if ($element === 'button') {
    $type = $type ?? 'button';
} else {
    $role = $role ?? 'button';
}
$dataAction = $dataAction ?? '';
$buttonAttributes = [
    'type'   => $type,
    'role' => $role,
    'class'  => AZ::helpers()->classes(
        'btn',
        'btn-' . $theme,
        ($size) ? 'btn-' . $size : '',
        $class ?? ''),
    'id' => $id ?? '',
    'href' => $href,
    'title' => $title,
    'data-action' => $dataAction,
];

?>

<{{ $element }} {!! AZ::helpers()->toHtmlAttributes($buttonAttributes) !!}>

{{ $slot }}

</{{ $element }}>
