@props(['query'])

<div class="gap-2">
    <x-ui.button type="modal" :id="$query->id" icon="bi bi-pencil" title="" class="btn-outline-warning" />

    <x-ui.modal-edit :id="$query->id" title="Edit Dudi" type="modal-xl">
        <form id="form-edit-dudi-{{ $query->id }}" action="{{ route('dudi.update', $query->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-12 mb-2">
                    <img src="{{ asset('storage/assets/back/img/dudi/' . $query->image) }}" alt="{{ $query->name }}"
                        id="preview-{{ $query->id }}" class="img-thumbnail" style="max-height:150px;">
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*"
                            onchange="previewEditImage(this, {{ $query->id }})">
                    </div>
                </div>
                <div class="col-md-6">
                    <x-ui.button type="input" title="Nama" name="name" placeholder="Masukkan Nama DUDI"
                        value="{{ old('name', $query->name) }}" />
                </div>
                <div class="col-md-6">
                    <x-ui.button type="input" title="Bidang" name="bidang" placeholder="Masukkan Bidang"
                        value="{{ old('bidang', $query->bidang) }}" />
                </div>
                <div class="col-md-6">
                    <x-ui.button type="input" title="Link Website" name="link" placeholder="https://example.com"
                        value="{{ old('link', $query->link) }}" />
                </div>
                <div class="col-md-6">
                    <x-ui.select name="status" title="Status">
                        <option disabled>-- Pilih Status --</option>
                        <option value="1" {{ old('status', $query->status) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status', $query->status) == 0 ? 'selected' : '' }}>Non Aktif
                        </option>
                    </x-ui.select>
                </div>
            </div>

            <div class="modal-footer">
                <x-ui.button type="tombol" icon="bi bi-save" title="Simpan" class="btn btn-outline-success" />
            </div>
        </form>
    </x-ui.modal-edit>

    <x-ui.button type="delete" id="{{ $query->id }}" url="{{ route('dudi.destroy', $query->id) }}" />
</div>

@once
    @push('scripts')
        <script>
            function previewEditImage(input, id) {
                const preview = document.getElementById('preview-' + id);
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => preview.src = e.target.result;
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endonce
