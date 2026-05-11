@props([
    'title' => '',
    'icon' => 'fa-database',
    'data' => '',
])

<div class="card mb-4">
    @if ($title)
        <div class="card-header d-flex align-items-center gap-2">
            <div class="d-flex align-items-center">
                <i class="fa-solid {{ $icon }} me-2"></i>
                <h3 class="card-title mb-0">{{ $title }}</h3>
                @if ($data)
                    <span class="badge bg-light text-dark border ms-2">{{ $data }}</span>
                @endif
            </div>
            
            <div class="ms-auto">
                @if (isset($headerAction))
                    {{ $headerAction }}
                @endif
            </div>
        </div>
    @endif

    <div {{ $attributes->merge(['class' => 'card-body ' . ($attributes->get('p-0') ? 'p-0' : 'p-3')]) }}>
        {{ $slot }}
    </div>
</div>
