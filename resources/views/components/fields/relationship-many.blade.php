<?php
$relatedEntry = null;
$id = null;
if (empty($value)) {
   $value = collect([]);
}
?>
<az-form-group>
    <div data-controller="relationship-many" data-relationship-many-slug="{{ $slug }}" data-relationship-many-related-slug="{{ $relatedTo->getSlug() }}" data-relationship-many-id="{{ $entryId }}" class="flex-grow-1">
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
        
    
    
        @foreach($value as $item)
            <az-card class="relationship__entry" data-id="{{ $item->id }}">
                <input type="hidden" name="{{ $name . '[]' }}" value="{{ $item->id }}" data-target="relationship-many.field">
                <az-card-body>
                    <div class="d-flex">
                        <div class="flex-grow-1"  data-action="click->relationship-many#openRelationship">
                            <div>
                                <b>{{ $item->label }}</b>
                            </div>
                            @if($item->description)
                                <div class="small text-secondary">
                                    {{ $item->description }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-0" data-action="click->relationship-many#remove">
                            <az-icon name="trash" class="text-danger"></az-icon>
                        </div>
                    </div>
        
                </az-card-body>
            </az-card>
        @endforeach
       
        
        <az-card class="w-100">
            <az-card-body>
                <az-button theme="secondary" data-action="click->relationship-many#openNew">Create New</az-button>
                <az-button theme="secondary" data-action="click->relationship-many#openExisting">Choose Existing</az-button>
            </az-card-body>
        </az-card>
        
        {{ $slot }}
        <slot name="tip">
            <az-field-tip>{{ $error ?? '' }}</az-field-tip>
            <az-field-error name="{{ $validationName }}">{{ $error ?? '' }}</az-field-error>
        </slot>
    </div>
</az-form-group>
