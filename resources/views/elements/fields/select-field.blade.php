<?php
    $name = $field->getName();
    $selected = old($field->getName());
    if ($attributes['value'] && !$selected) {
        $selected = $attributes['value'];
    }
?>

@component('adminzone::components.fields.select', $attributes)
    @slot('label')
        {{ $label }}
    @endslot
    @foreach($field->getOptions() as $v => $label))
        <option value="{{ $v }}" @if($selected === $v) selected @endif>{{ $label }}</option>
    @endforeach
@endcomponent
