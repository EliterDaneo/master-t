@props([
    'striped' => false,
    'small' => false,
    'bordered' => false,
    'id' => null,
])

@php
    $classes = 'table';
    $classes .= $striped ? ' table-striped' : '';
    $classes .= $small ? ' table-sm' : '';
    $classes .= $bordered ? ' table-bordered' : '';
@endphp

<div class="table-responsive">
    <table class="{{ $classes }}" role="table" id="{{ $id ?? '' }}">
        {{ $slot }}
    </table>
</div>
