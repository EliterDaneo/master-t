@props(['query'])

<div class="d-flex justify-content-center gap-1">
    <a href="{{ route('produk.edit', $query->id) }}" class="btn btn-outline-warning mb-2">
        <i class="bi bi-pencil"></i>
    </a>

    <x-ui.button type="delete" id="{{ $query->id }}" url="{{ route('produk.destroy', $query->id) }}" />
</div>
