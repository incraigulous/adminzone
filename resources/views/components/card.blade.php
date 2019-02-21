<?php
$href = $href ?? null;
$class = $class ?? null;
$imageTop = $image ?? '';
$themeColor = $themeColor ?? 'white';
$element = $element ?? 'div';
$dataAction = $dataAction ?? null;
$dataTarget = $dataTarget ?? null;
if ($element === 'div' && $href) {
    $element = 'a';
}
$textColor = $textColor ?? AZ::helpers()->textColorFromTheme($themeColor);
$attributes = $attributes ?? [
        'class'   => AZ::helpers()->classes('card', $class, "bg-{$themeColor}", "text-{$textColor}"),
        'href'    => $href,
        'data-id' => $dataId ?? null
    ];
?>
<{{ $element }} {!! AZ::helpers()->toHtmlAttributes($attributes) !!} data-target="{{ $dataTarget }}" data-action="{{ $dataAction }}">
{{ $slot }}
</{{ $element }}>
