@extends('components.layouts.back.app', ['title' => 'Tambah Visi & Misi'])

@section('content')
    <x-ui.card title="Tambah Visi & Misi" icon="bi bi-plus">
        <form action="{{ route('vm.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-ui.select name="type" title="Pilih Tipe">
                        <option selected disabled>-- Pilih Tipe --</option>
                        <option value="vision" {{ old('type') == 'vision' ? 'selected' : '' }}>Visi</option>
                        <option value="mission" {{ old('type') == 'mission' ? 'selected' : '' }}>Misi</option>
                    </x-ui.select>
                </div>
                <div class="col-md-3">
                    <x-ui.button type="input" title="Urutan" name="order" placeholder="Masukkan Urutan"
                        value="{{ old('order', 0) }}" />
                </div>
                <div class="col-md-3">
                    <x-ui.select name="status" title="Pilih Status">
                        <option selected disabled>-- Pilih Status --</option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Non Aktif</option>
                    </x-ui.select>
                </div>

                <x-ui.textarea title="Isi Berita" name="h"
                    placeholder="Masukkan Konten / Isi Berita">{!! old('h') !!}</x-ui.textarea>
            </div>
            <x-ui.button type="tombol" title="Simpan" icon="bi bi-save" />
            <x-ui.button type="link" url="{{ route('vm.index') }}" title="Kembali" icon="bi bi-arrow-left"
                class="btn-outline-danger" />
        </form>
    </x-ui.card>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
    <script>
        var editor_config = {
            selector: "textarea.content",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
        };

        tinymce.init(editor_config);
    </script>
@endpush
