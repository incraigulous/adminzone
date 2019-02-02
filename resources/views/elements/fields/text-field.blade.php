<az-field-text :value="$value" :name="$name">
    <slot name="label">
        {{ $field->getLabel() }}
    </slot>
</az-field-text>
