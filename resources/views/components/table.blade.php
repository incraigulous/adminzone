<?php
    $striped = $striped ?? false;
    $headClass = $headClass ?? 'thead-dark';
    $class = AZ::helpers()->classes(
        $class ?? '',
        'table',
        ($striped) ? 'table-striped' : ''
    );
    $attributes = $attributes ?? AZ::helpers()->attributes([
        'class' => $class
    ]);
    $head = $head ?? null;
?>
<table {!! $attributes !!}>
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
</table>
