<h6>MENU</h6>
<az-nav class="resources-menu flex-column">
    <az-nav-item :href="url()->route('adminzone::dashboard')">
            Dashboard
    </az-nav-item>
    @foreach($resources as $resource)
        <az-nav-item :href="route('adminzone::resource', ['slug' => $resource->slug])">
            {{ $resource->collectionLabel }}
        </az-nav-item>
    @endforeach
</az-nav>
