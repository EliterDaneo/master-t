@props(['query'])

<div class="gap-2">
    <x-ui.button type="modal" :id="$query->id" icon="fa-solid fa-pen-to-square" icon="bi-pencil" />

    <x-ui.modal-edit :id="$query->id" title="Edit Kategori" type="modal-xl">
        <form id="form-edit-slider-{{ $query->id }}" action="{{ route('slider.update', $query->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mt-2">
                <img id="preview"
                    src="{{ $query->image ? asset('storage/assets/back/img/slider/' . $query->image) : '#' }}"
                    alt="Preview" class="img-thumbnail {{ $query->image ? '' : 'd-none' }}" style="max-height:200px">
            </div>

            <x-ui.button type="input" newType="file" title="Image" name="image" placeholder="Masukkan Image" />

            <x-ui.button type="input" title="Judul" name="title" placeholder="Masukkan Judul" :value="$query->title" />

            <x-ui.select name="status" title="Pilih Status">
                <option disabled>Pilih Status</option>
                <option value="1" {{ $query->status == 1 ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="0" {{ $query->status == 0 ? 'selected' : '' }}>
                    Tidak Aktif
                </option>
            </x-ui.select>

            <x-ui.button type="tombol" title="Update" icon="bi bi-save" />
        </form>
    </x-ui.modal-edit>

    <x-ui.button type="delete" id="{{ $query->id }}" url="{{ route('slider.destroy', $query->id) }}" />

</div>
