<?php
    $method =  strtoupper($method ?? '');
    $attributes = $attributes ?? [
        'action' => $href,
        'method' => AZ::helpers()->formMethod($method)
    ];
?>

<form {!! AZ::helpers()->toHtmlAttributes($attributes) !!} data-controller="form-link">
    @csrf
    @if(AZ::helpers()->isSpoofedMethod($method))
        @method($method)
    @endif
    <span data-action="click->form-link#submit">
        {{ $slot }}
    </span>
</form>
