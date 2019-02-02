<?php
$class = AZ::helpers()->classes("top-bar", "mb-0", $class ?? '');
$dataTarget = $dataTarget ?? null;
$themeColor = $themeColor ?? 'dark';
?>

<az-navbar :class="$class" :data-target="$dataTarget" :theme-color="$themeColor">
    <slot name="left">
        <az-search-form :resources="$resources"></az-search-form>
    </slot>
    <slot name="right">
        <az-user-menu></az-user-menu>
    </slot>
</az-navbar>
