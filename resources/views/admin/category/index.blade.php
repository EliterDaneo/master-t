@extends('components.layouts.back.app', ['title' => 'Daftar Kategori Tefa'])

@section('content')
    <div class="row">
        <div class="col-md-4">
            <x-ui.card title="Form Kategori" icon="bi bi-tag">
                <form id="form-category" action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <x-ui.button type="input" title="Nama Kategori" name="name" placeholder="Masukkan Nama Kategori" />

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
            <x-ui.card title="Daftar Kategori" icon="bi bi-list">
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
        $(function() {
            // Handle form create & edit
            AjaxCrudHelper.handleForm('#form-category', '#category-table');
            AjaxCrudHelper.handleForm('[id^="form-edit-category-"]', '#category-table');

            // Handle delete
            AjaxCrudHelper.handleDelete('.btn-delete', '#category-table');
        });
    </script>
@endpush
