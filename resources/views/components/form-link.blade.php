<?php
    $method = $method ?? 'POST';
    
    $attributes = $attributes ?? [
        'action' => $href,
        'method' => $method
    ];
?>

<form {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    @csrf
    <az-button theme="link" type="submit" class="m-0 p-0">
        {{ $slot }}
    </az-button>
</form>
