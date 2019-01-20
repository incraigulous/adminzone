<a class="d-block alert alert-{{ $context ?? 'primary' }} {{ $class ?? '' }}" role="alert" href="{{ $linkUrl ?? '' }}">
    <div class="container position-relative">
        {{ $slot }}
    </div>
</a>
