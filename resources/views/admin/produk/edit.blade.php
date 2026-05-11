@extends('components.layouts.back.app', ['title' => 'Edit Produk'])

@section('content')
    <x-ui.card title="Edit Produk" icon="bi bi-pencil-square">
        <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <label class="form-label d-block text-left">Foto Produk Saat Ini</label>
                        <img id="img-preview" src="{{ asset('storage/assets/back/img/produk/' . $produk->image) }}"
                            alt="Preview" class="img-thumbnail mb-2" style="max-height: 250px;">
                        <input type="file" name="image" class="form-control" accept="image/*"
                            onchange="previewImage(this)">
                        <small class="text-muted text-left d-block mt-1">Biarkan kosong jika tidak ingin mengganti
                            gambar.</small>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <x-ui.button type="input" title="Nama Produk" name="title"
                                value="{{ old('title', $produk->title) }}" />
                        </div>
                        <div class="col-md-4">
                            <x-ui.button type="input" type_input="number" title="Harga (Rp)" name="price"
                                value="{{ old('price', $produk->price) }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <x-ui.select name="category_id" title="Kategori Produk">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $produk->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </x-ui.select>
                        </div>
                        <div class="col-md-6">
                            <x-ui.select name="status" title="Status Publish">
                                <option value="1" {{ old('status', $produk->status) == '1' ? 'selected' : '' }}>Aktif /
                                    Publish</option>
                                <option value="0" {{ old('status', $produk->status) == '0' ? 'selected' : '' }}>Draft /
                                    Non-Aktif</option>
                            </x-ui.select>
                        </div>
                    </div>
                </div>
            </div>

            <x-ui.textarea name="content" title="Deskripsi Produk"
                placeholder="Masukkan Deskripsi Produk">{!! old('content', $produk->content) !!}</x-ui.textarea>

            <div class="mt-4">
                <x-ui.button type="tombol" title="Update Produk" icon="bi bi-save" />
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
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(input.files[0]);
            }
        }

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
