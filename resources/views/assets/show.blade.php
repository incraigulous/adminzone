@if($asset)
    <div class="asset-preview asset-preview--{{ $asset->type }}">
        @includeFirst(['adminzone::assets.types.' . $asset->type, 'adminzone::assets.types.default'], compact('asset'))
    </div>
@endif
