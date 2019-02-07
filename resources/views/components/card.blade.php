<?php
$href = $href ?? null;
$class = $class ?? null;
$imageTop = $image ?? '';
$themeColor = $themeColor ?? 'white';
$element = $element ?? 'div';
if ($element === 'div' && $href) {
    $element = 'a';
}
$textColor = $textColor ?? AZ::helpers()->textColorFromTheme($themeColor);
$attributes = $attributes ?? [
    'class' => AZ::helpers()->classes('card', $class, "bg-{$themeColor}", "text-{$textColor}"),
    'href' => $href,
    'data-action' => $dataAction ?? null,
    'data-target' => $dataTarget ?? null,
    'data-id' => $dataId ?? null
];
?>
<{{ $element }} {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
   {{ $slot }}
</{{ $element }}>
