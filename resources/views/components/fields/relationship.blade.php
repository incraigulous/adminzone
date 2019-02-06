<?php
    $relatedEntry = null;
    $id = null;
    if (!empty($value)) {
        if (is_object($value)) {
            $relatedEntry = $value;
            $value = $relatedEntry->id;
        } else {
            $relatedEntry = $relatedTo->getRepository()->find($value);
        }
    }
?>
<az-form-group>
    <div data-controller="relationship" data-relationship-slug="{{ $slug }}" data-relationship-related-slug="{{ $relatedTo->getSlug() }}" data-relationship-id="{{ $entryId }}" class="flex-grow-1">
        @if($label)
            <slot name="label">
                {{  $label }}
            </slot>
        @endif
        @if($before)
            <slot name="prepend">
                {{ $before }}
            </slot>
        @endif
        
        <input type="hidden" name="{{ $name }}" value="{{ $value }}" data-target="relationship.field">

        @if(!$value)
            <az-card class="w-100">
                <az-card-body>
                    <az-button theme="secondary" data-action="click->relationship#openNew">Create New</az-button>
                    <az-button theme="secondary" data-action="click->relationship#openExisting">Choose Existing</az-button>
                </az-card-body>
            </az-card>
        @else
            <az-card class="relationship__entry">
                <az-card-body>
                    <div class="d-flex">
                        <div class="flex-grow-1"  data-action="click->relationship#openRelationship">
                            <div>
                                <b>{{ $relatedEntry->label }}</b>
                            </div>
                            @if($relatedEntry->description)
                                <div class="small text-secondary">
                                    {{ $relatedEntry->description }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-0" data-action="click->relationship#remove">
                            <az-icon name="trash" class="text-danger"></az-icon>
                        </div>
                    </div>
                    
                </az-card-body>
            </az-card>
        @endif

        {{ $slot }}
        <slot name="tip">
            <az-field-tip>{{ $error ?? '' }}</az-field-tip>
            <az-field-error name="{{ $validationName }}">{{ $error ?? '' }}</az-field-error>
        </slot>
    </div>
</az-form-group>
