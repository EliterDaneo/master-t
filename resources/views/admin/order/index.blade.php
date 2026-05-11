@extends('components.layouts.back.app', ['title' => 'Manajemen Pesanan'])

@section('content')
    <x-ui.card title="Daftar Pesanan Masuk" icon="bi bi-table">
        {{ $dataTable->table(['width' => '100%', 'class' => 'table table-striped']) }}
    </x-ui.card>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(function() {
            AjaxCrudHelper.handleForm('#form-order', '#order-table');
            AjaxCrudHelper.handleDelete('.btn-delete', '#order-table');
        });
    </script>
@endpush
