@props([
    'type' => '',
    'title' => '',
    'id' => '',
    'url' => '',
    'icon' => false,
    'class' => 'btn btn-outline-primary',
    'dataId' => '',
    'dataReason' => '',
    'hover' => '',
    'path' => '',
    'span' => '',
    'value' => '',
    'name' => '',
    'placeholder' => '',
    'newType' => 'text',
])

@switch($type)
    @case('navLink')
        <li class="nav-item">
            <a href="{{ $url }}" class="nav-link {{ setActive($path) }}">
                <i class="nav-icon bi {{ $icon }}"></i>
                <p>{{ $title }}</p>
                @if ($span != null)
                    <span class="{{ $span }}">{{ $value }}</span>
                @endif
            </a>
        </li>
    @break

    @case('link')
        <a href="{{ $url }}" class="btn {{ $class }} mb-2" title="{{ $hover }}">
            <i class="{{ $icon }}"></i>
            {{ $title }}
        </a>
    @break

    @case('tombol')
        <button type="submit" class="btn {{ $class }} mb-2" data-id="{{ $dataId ?? '' }}"
            data-reason="{{ $dataReason ?? '' }}" title="{{ $hover }}">
            <i class="{{ $icon }}"></i>
            {{ $title }}
        </button>
    @break

    @case('delete')
        <a href="#" data-url="{{ $url }}" data-id="{{ $id }}"
            {{ $attributes->merge(['class' => 'btn btn-outline-danger btn-delete mb-2']) }} title="{{ $hover }}">
            <i class="bi bi-trash"></i>
            {{ $title }}
        </a>

        <form id="delete-form-{{ $id }}" action="{{ $url }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @break

    @case('modal')
        <button class="btn {{ $class }} mb-2" data-bs-toggle="modal" data-bs-target="#modal-simple-{{ $id }}"
            title="{{ $hover }}">
            @if ($icon)
                <i class="{{ $icon }}"></i>
            @endif
            {{ $title }}
        </button>
    @break

    @case('modal-create')
        @php $modalId = $id ?: 'modal-simple-create'; @endphp
        <button class="btn {{ $class }} mb-2" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}"
            title="{{ $hover }}">
            @if ($icon)
                <i class="{{ $icon }}"></i>
            @endif
            {{ $title }}
        </button>
    @break

    @case('input')
        <div class="mb-3 form-group">
            <label for="{{ $name }}" class="form-label">{{ $title }}</label>
            <input type="{{ $newType }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
                name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}"
                {{ $attributes }}>
            @error($name)
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    @break

@endswitch
