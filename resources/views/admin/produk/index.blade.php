@extends('components.layouts.back.app', ['title' => 'Manajemen Produk'])

@section('content')
    <x-ui.button type="link" url="{{ route('produk.create') }}" title="Tambah Produk" icon="bi bi-plus" />
    <x-ui.card title="Daftar Produk" icon="bi bi-box-seam">
        <x-ui.table bordered>
            {{ $dataTable->table(['width' => '100%', 'class' => 'table table-striped align-middle']) }}
        </x-ui.table>
    </x-ui.card>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(function() {
            AjaxCrudHelper.handleDelete('.btn-delete', '#produk-table');
        });
    </script>
@endpush
