<?php
    $entry = $entry ?? null;
    $id = $entry ? $entry->id : null
?>
<div data-controller="conditional" data-conditional-section-id="{{ $section->getId() }}" data-conditional-id="{{ $id }}" data-conditional-slug="{{ $resource->getSlug() }}">
    @if($entry)
        @include('adminzone::elements.elements', ['elements' => $section->getConditionalFields($entry)])
    @endif
</div>
