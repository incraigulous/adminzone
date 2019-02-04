<az-field-relationship :value="$value" :name="$name">
    <slot name="before">
        <az-icon name="envelope"></az-icon>
    </slot>
    
    <slot name="label">
        {{ $field->getLabel() }}
    </slot>
</az-field-relationship>
