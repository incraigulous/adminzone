<az-navbar themeColor="white" class="utility-nav">
    <slot name="left">
        <h5 class="mb-0">{{ Breadcrumbs::current()->title }}</h5>
    </slot>
    <slot name="right">
        {{ Breadcrumbs::render(Route::currentRouteName()) }}
    </slot>
</az-navbar>
