<?php
    $striped = $striped ?? false;
    $hover = $hover ?? false;
    $headClass = $headClass ?? 'thead-dark';
    $class = AZ::helpers()->classes(
        $class ?? '',
        'table',
        ($striped) ? 'table-striped' : '',
        ($hover) ? 'table-hover' : ''
    );
    $attributes = $attributes ?? AZ::helpers()->attributes([
        'class' => $class
    ]);
    $head = $head ?? null;
    $element = $element ?? 'table';
?>
<div class="table-container">
    <{{ $element }} {!! $attributes !!}>
        @if($head)
            <thead class="{{ $headClass }}">
                <tr>
                    {{ $head }}
                </tr>
            </thead>
        @endif
        <tbody>
            {{ $slot }}
        </tbody>
    </{{ $element }}>
</div>
