<az-field-upload :value="$value" :name="$name">
    
    <slot name="label">
        {{ $field->getLabel() }}
    </slot>

</az-field-upload>
