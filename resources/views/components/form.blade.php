<?php
$method =  strtoupper($method ?? '');
$errors = $errors->count() ? collect($errors->all()) : collect([]);
$dataTarget = $dataTarget ?? '';
$submit = $submit ?? null;
$submitLabel = $submitLabel ?? 'Submit';
$dataAction = isset($dataAction) ? $dataAction . ' ' : '';
$dataAction = $dataAction . 'submit->form#submit';
$shouldRedirect = $shouldRedirect ?? request()->headers->get('x-layout') !== 'overlay';

$attributes = $attributes ?? [
        'method' => AZ::helpers()->formMethod($method),
        'action' => $action ?? '',
        'data-action' => $dataAction,
        'novalidate' => 'novalidate',
        'enctype' => $enctype ?? null,
        'data-controller' => 'form',
        'data-form-should-redirect' => $shouldRedirect
    ];
?>
<form class="form {{ $class ?? '' }}" {!! AZ::helpers()->toHtmlAttributes($attributes); !!}>
    <az-alert theme="danger" class="d-none" data-target="form.errorAlert"></az-alert>
    <az-alert theme="success" class="d-none" data-target="form.successAlert"></az-alert>
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
    @if($submit)
        {{ $submit }}
    @else
        <az-button type="submit" data-target="form.submitButton">{{ $submitLabel }}</az-button>
    @endif
</form>
