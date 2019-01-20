<az-nav class="navbar-nav">
    <az-nav-item :active="true" class="bg-secondary">
        {{ auth()->user()->name }}
        <slot name="dropdown">
            <az-dropdown-item>
                <az-form-link :href="url()->route('logout')">
                    Logout
                </az-form-link>
            </az-dropdown-item>
        </slot>
    </az-nav-item>
</az-nav>
