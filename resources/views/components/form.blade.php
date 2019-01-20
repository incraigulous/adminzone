<?php
$attributes = $attributes ?? [
        'method' => $method ?? 'POST',
        'action' => $action ?? '',
        'data-target' => $dataTarget ?? '',
        'data-action' => $dataAction ?? '',
        'novalidate' => 'novalidate'
    ];
?>
<form class="form {{ $class ?? '' }}" {!! AZ::helpers()->toHtmlAttributes($attributes); !!}>
    @if(!empty($errors->first()))
        <div class="alert alert-danger">{{ $errors->first() }} </div>
    @endif
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</div>
        @endif
    @endforeach
    {{ $slot }}
</form>
