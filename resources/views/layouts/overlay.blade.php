<?php
    $direction = request()->headers->has('x-overlay-direction') ? request()->headers->get('x-overlay-direction') : 'right';
?>
<div class="overlay-stack__overlay-container overlay-stack__overlay-container--from-{{ $direction }}" data-controller="overlay">
    <div class="overlay-stack__overlay">
        <div class="d-flex flex-row h-100">
            <div class="flex-grow-0 overlay-stack__overlay__handle">
                <az-button class="overlay-stack__overlay__handle__close" theme="danger" data-action="click->overlay#close">
                    <az-icon name="times-circle"></az-icon>
                </az-button>
        
            </div>
            <div class="flex-grow-1 overlay-stack__overlay__content">
                @yield('main')
            </div>
        </div>
    </div>
</div>
