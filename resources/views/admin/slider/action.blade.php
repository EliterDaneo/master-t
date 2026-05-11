@props(['query'])

<div class="gap-2">
    <x-ui.button type="modal" :id="$query->id" icon="fa-solid fa-pen-to-square" icon="bi-pencil" />

    <x-ui.modal-edit :id="$query->id" title="Edit Kategori" type="modal-xl">
        <form id="form-edit-category-{{ $query->id }}" action="{{ route('category.update', $query->id) }}"
            method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <x-ui.button type="input" title="Nama Kategori" name="name"
                        placeholder="Masukkan Nama Kategori" value="{{ old('name', $query->name) }}" />
                </div>
                <div class="col-md-6">
                    <x-ui.select title="Status" name="status">
                        <option value="1" {{ old('status', $query->status) == 1 ? 'selected' : '' }}>
                            Aktif</option>
                        <option value="0" {{ old('status', $query->status) == 0 ? 'selected' : '' }}>
                            Tidak Aktif</option>
                    </x-ui.select>
                </div>
            </div>

            <div class="modal-footer">
                <x-ui.button type="tombol" icon="bi bi-save" title="Simpan" class="btn btn-outline-success" />
            </div>
        </form>
    </x-ui.modal-edit>

    <x-ui.button type="delete" id="{{ $query->id }}" url="{{ route('slider.destroy', $query->id) }}" />

</div>
