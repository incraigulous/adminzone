<?php
    $logoutUrl = \Route::has('logout') ? url()->route('logout') : '/logout';
    $class = \AZ::helpers()->classes('d-flex', $class ?? null);
?>
<az-dropdown alignment="right" :class="$class">
    <az-button theme="secondary">
        {{ auth()->user()->name }}
    </az-button>
    @if(auth()->user()->avatar)<img class="img-thumbnail border-0 avatar p-0 d-flex" src="{{ asset(auth()->user()->avatar->file) }}">@endif
    <slot name="menu">
        <az-form-link :href="$logoutUrl">
            <az-dropdown-item>
                Logout
            </az-dropdown-item>
        </az-form-link>
    </slot>
</az-dropdown>
