@props(['title' => '', 'name' => ''])
<div class="mb-3 form-group">
    <label for="{{ $name }}" class="form-label">{{ $title }}</label>
    <select class="form-control select2bs4 @error($name) is-invalid @enderror" name="{{ $name }}"
        {{ $attributes }} id="{{ $name }}" style="width: 100%;">
        {{ $slot }}
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
