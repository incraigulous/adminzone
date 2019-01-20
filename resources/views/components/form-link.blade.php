<?php
    $method = $method ?? 'POST';
    
    $attributes = $attributes ?? [
        'action' => $href,
        'method' => $method
    ];
?>

<form {!! AZ::helpers()->toHtmlAttributes($attributes) !!}>
    @csrf
    <az-button theme="link" size="sm" type="submit">
        {{ $slot }}
    </az-button>
</form>
