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

        <input type="hidden" name="{{ $name }}" value="{{ $value ? $value->id : null }}" data-target="relationship.field">

        @if(!$value)
            <az-card class="w-100">
                <az-card-body>
                    @if($relatedTo->canCreate())
                        <az-button theme="secondary" data-action="click->relationship#openNew">Create New</az-button>
                    @endif
                    <az-button theme="secondary" data-action="click->relationship#openExisting">Choose Existing</az-button>
                </az-card-body>
            </az-card>
        @else
            <az-card class="relationship__entry">
                <az-card-body>
                    <div class="d-flex">
                        <div class="flex-grow-1"  data-action="click->relationship#openRelationship">
                            <div>
                                <b>{{ $value->label }}</b>
                            </div>
                            @if($value->description)
                                <div class="small text-secondary">
                                    {{ $value->description }}
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
