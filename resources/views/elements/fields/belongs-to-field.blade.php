<az-field-relationship :value="$value" :name="$name">
    <slot name="label">
        {{ $field->getLabel() }}
    </slot>
</az-field-relationship>
