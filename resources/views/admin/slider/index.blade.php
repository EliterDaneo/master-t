@extends('components.layouts.back.app', ['title' => 'Daftar Slider'])

@section('content')
    <div class="row">
        <div class="col-md-4">
            <x-ui.card title="Form Sliter" icon="bi bi-tag">
                <form id="form-slider" action="{{ route('slider.store') }}" method="POST">
                    @csrf
                    <div class="mt-2">
                        <img id="preview" src="#" alt="Preview" class="img-thumbnail d-none"
                            style="max-height:200px">
                    </div>
                    <x-ui.button type="input" newType="file" title="Image" name="image" placeholder="Masukkan Image" />

                    <x-ui.button type="input" title="Judul" name="title" placeholder="Masukkan Judul" />

                    <x-ui.select name="status" title="Pilih Status">
                        <option disabled selected>Pilih Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </x-ui.select>

                    <x-ui.button type="tombol" title="Simpan" icon="bi bi-save" />
                </form>
            </x-ui.card>
        </div>
        <div class="col-md-8">
            <x-ui.card title="Daftar Slider" icon="bi bi-list">
                <x-ui.table bordered>
                    {{ $dataTable->table(['width' => '100%', 'class' => 'table table-striped']) }}
                </x-ui.table>
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
            AjaxCrudHelper.handleForm('#form-slider', '#slider-table');
            AjaxCrudHelper.handleForm('[id^="form-edit-slider-"]', '#slider-table');

            // Handle delete
            AjaxCrudHelper.handleDelete('.btn-delete', '#slider-table');
        });
    </script>
@endpush
