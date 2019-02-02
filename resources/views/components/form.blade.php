<?php
$method =  strtoupper($method ?? '');
$errors = $errors->count() ? collect($errors->all()) : collect([]);

$attributes = $attributes ?? [
        'method' => AZ::helpers()->formMethod($method),
        'action' => $action ?? '',
        'data-target' => $dataTarget ?? '',
        'data-action' => $dataAction ?? '',
        'novalidate' => 'novalidate',
        'enctype' => $enctype ?? null
    ];
?>
<form class="form {{ $class ?? '' }}" {!! AZ::helpers()->toHtmlAttributes($attributes); !!}>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @if(AZ::helpers()->isSpoofedMethod($method))
        @method($method)
    @endif
    @foreach($errors as $error)
        <div class="alert alert-danger">{{ $error }} </div>
    @endforeach
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</div>
        @endif
    @endforeach
    {{ $slot }}
</form>
