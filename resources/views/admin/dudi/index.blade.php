@extends('components.layouts.back.app', ['title' => 'Daftar Dudi'])

@section('content')
    <div class="row">
        <div class="col-md-4">
            <x-ui.card title="Form Dudi" icon="bi bi-building">
                <form id="form-dudi" action="{{ route('dudi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-2 mb-2">
                        <img id="preview" src="#" alt="Preview" class="img-thumbnail d-none"
                            style="max-height:200px">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*"
                            onchange="previewImage(this)">
                    </div>

                    <x-ui.button type="input" title="Nama" name="name" placeholder="Masukkan Nama DUDI" />
                    <x-ui.button type="input" title="Bidang" name="bidang" placeholder="Masukkan Bidang" />
                    <x-ui.button type="input" title="Link Website" name="link" placeholder="https://example.com" />

                    <x-ui.select name="status" title="Status">
                        <option disabled selected>-- Pilih Status --</option>
                        <option value="1">Aktif</option>
                        <option value="0">Non Aktif</option>
                    </x-ui.select>

                    <x-ui.button type="tombol" title="Simpan" icon="bi bi-save" />
                </form>
            </x-ui.card>
        </div>

        <div class="col-md-8">
            <x-ui.card title="Daftar Dudi" icon="bi bi-list">
                {{ $dataTable->table(['width' => '100%', 'class' => 'table table-striped']) }}
            </x-ui.card>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(function() {
            // Handle form create & edit
            AjaxCrudHelper.handleForm('#form-dudi', '#dudi-table');
            AjaxCrudHelper.handleForm('[id^="form-edit-dudi-"]', '#dudi-table');

            // Handle delete
            AjaxCrudHelper.handleDelete('.btn-delete', '#dudi-table');
        });
    </script>
@endpush
