@extends('components.layouts.back.app', ['title' => 'Tambah Produk'])

@section('content')
    <x-ui.card title="Tambah Produk Baru" icon="bi bi-plus-circle">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Foto Produk</label>
                        <input type="file" name="image" class="form-control" accept="image/*"
                            onchange="previewImage(this)">
                        <div class="mt-3">
                            <img id="img-preview" src="#" alt="Preview" class="img-thumbnail d-none"
                                style="max-height: 250px;">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <x-ui.button type="input" title="Nama Produk" name="title"
                                placeholder="Contoh: Kursi Kayu Jati" value="{{ old('title') }}" />
                        </div>
                        <div class="col-md-4">
                            <x-ui.button type="input" type_input="number" title="Harga (Rp)" name="price"
                                placeholder="0" value="{{ old('price') }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-ui.select name="category_id" title="Kategori Produk">
                                <option disabled selected>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-ui.select>
                        </div>
                        <div class="col-md-6">
                            <x-ui.select name="status" title="Status Publish">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif / Publish</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Draft / Non-Aktif
                                </option>
                            </x-ui.select>
                        </div>
                    </div>
                </div>
            </div>

            <x-ui.textarea name="content" title="Deskripsi Produk" placeholder="Masukkan Deskripsi Produk">{!! old('content') !!}</x-ui.textarea>

            <div class="mt-4">
                <x-ui.button type="tombol" title="Simpan Produk" icon="bi bi-save" />
                <x-ui.button type="link" url="{{ route('produk.index') }}" title="Batal" icon="bi bi-x-circle"
                    class="btn-outline-danger" />
            </div>
        </form>
    </x-ui.card>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
    <script>
        function previewImage(input) {
            const preview = document.getElementById('img-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        tinymce.init({
            selector: "textarea.content-editor",
            height: 400,
            plugins: "advlist autolink lists link image charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table directionality emoticons template paste textpattern",
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
        });
    </script>
@endpush
