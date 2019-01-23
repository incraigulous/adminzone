<?php
    $logoutUrl = \Route::has('logout') ? url()->route('logout') : '/logout';
?>
<az-dropdown alignment="right">
    <az-button theme="secondary">{{ auth()->user()->name }}</az-button>
    <slot name="menu">
        <az-dropdown-item>
            <az-form-link :href="$logoutUrl">
                Logout
            </az-form-link>
        </az-dropdown-item>
    </slot>
</az-dropdown>
