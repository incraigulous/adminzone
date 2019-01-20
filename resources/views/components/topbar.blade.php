<az-navbar class="top-bar mb-0" theme-color="dark">
    <slot name="left">
        <az-search-form :resources="$resources"></az-search-form>
    </slot>
    <slot name="right">
        <az-user-menu></az-user-menu>
    </slot>
</az-navbar>
