@extends('components.layouts.back.app', ['title' => 'Edit Berita'])

@section('content')
    <x-ui.card title="Edit Berita" icon="bi bi-pencil-square">
        <form action="{{ route('berita.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <!-- Tampilkan preview gambar lama jika ada -->
                    @if ($post->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/assets/back/img/berita/' . $post->image) }}" alt="Gambar Berita"
                                class="img-thumbnail" style="height: 100px;">
                            <small class="text-muted d-block">Gambar saat ini</small>
                        </div>
                    @endif
                    <x-ui.button type="input" newType="file" title="Ganti Gambar (Opsional)" name="image"
                        placeholder="Masukkan Gambar" />
                </div>
                <div class="col-md-6">
                    <!-- Gunakan $post->title sebagai default value -->
                    <x-ui.button type="input" newType="text" title="Judul Berita" name="title"
                        placeholder="Masukkan Judul Berita" value="{{ old('title', $post->title) }}" />
                </div>
            </div>

            <x-ui.select name="category_id" title="Pilih Kategori">
                <option disabled>Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </x-ui.select>

            <!-- Textarea diisi dengan data konten lama -->
            <x-ui.textarea title="Isi Berita" name="content" class="content"
                placeholder="Masukkan Konten / Isi Berita">{!! old('content', $post->content) !!}</x-ui.textarea>

            <div class="mt-4">
                <x-ui.button type="tombol" title="Update Berita" icon="bi bi-save" />
                <x-ui.button type="link" url="{{ route('berita.index') }}" title="Kembali" icon="bi bi-arrow-left"
                    class="btn-outline-danger" />
            </div>

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
