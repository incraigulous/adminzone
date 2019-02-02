<?php
    $logoutUrl = \Route::has('logout') ? url()->route('logout') : '/logout';
?>
<az-dropdown alignment="right">
    <az-button theme="secondary">{{ auth()->user()->name }}</az-button>
    <slot name="menu">
        <az-form-link :href="$logoutUrl">
            <az-dropdown-item>
                Logout
            </az-dropdown-item>
        </az-form-link>
    </slot>
</az-dropdown>
