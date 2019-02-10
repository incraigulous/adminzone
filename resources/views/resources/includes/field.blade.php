@if(is_object($field) && $field instanceof \Incraigulous\AdminZone\Contracts\FormatterInterface)
    {!! $field->format($entry) !!}
@else
    {!! AZ::helpers()->callbackOr(function($field, $entry) {
        return $entry->$field;
    }, $field, $entry) !!}
@endif
