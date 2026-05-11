@extends('components.layouts.back.app', ['title' => 'Tambah Berita'])

@section('content')
    <x-ui.card title="Tambah Berita" icon="bi bi-plus">
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <x-ui.button type="input" newType="file" title="Gambar" name="image" placeholder="Masukkan Gambar" />
                </div>
                <div class="col-md-6">
                    <x-ui.button type="input" newType="text" title="Judul Berita" name="title"
                        placeholder="Masukkan Judul Berita" value="{{ old('title') }}" />
                </div>
            </div>

            <x-ui.select name="category_id" title="Pilih Kategori">
                <option disabled selected>Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-ui.select>

            <x-ui.textarea title="Isi Berita" name="content"
                placeholder="Masukkan Konten / Isi Berita">{!! old('content') !!}</x-ui.textarea>

            <x-ui.button type="tombol" title="Simpan" icon="bi bi-save" />
            <x-ui.button type="link" url="{{ route('berita.index') }}" title="Kembali" icon="bi bi-arrow-left" class="btn-outline-danger" />

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
