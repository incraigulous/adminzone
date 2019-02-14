<?php
$class = AZ::helpers()->classes("top-bar", "mb-0", $class ?? '');
$dataTarget = $dataTarget ?? null;
$themeColor = $themeColor ?? 'dark';
?>

<az-navbar :class="$class" :data-target="$dataTarget" :theme-color="$themeColor">
    <slot name="left">
        <az-button theme="primary" class="toggle__button d-lg-none" data-action="click->dashboard#toggleSidebar">
            <az-icon name="bars"></az-icon>
        </az-button>
        <az-search-form :resources="$resources" class="d-none d-lg-flex"></az-search-form>
    </slot>
    <slot name="right">
        <az-user-menu class="d-sidebar-open-none"></az-user-menu>
    </slot>
</az-navbar>
