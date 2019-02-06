<?php
$slug = 'asset';
$class = $class ?? '';
$class = AZ::helpers()->classes('related-entry', $class);
?>

<div data-controller="related-entry" data-related-entry-slug="{{ $slug }}" data-related-entry-id="{{ $entry->id }}" data-related-entry-name="{{ $name }}">
    <az-card :class="$class" data-action="click->related-entry#open">
        <az-card-body>
            <div>
                <b>{{ $entry->label }}</b>
            </div>
            @if($entry->description)
                <div class="small text-secondary">
                    {{ $entry->description }}
                </div>
            @endif
        </az-card-body>
    </az-card>
</div>
