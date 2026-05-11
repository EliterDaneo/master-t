@extends('components.layouts.back.app', ['title' => 'Tambah Struktur'])

@section('content')
    <x-ui.card title="Tambah Struktur" icon="bi bi-plus">
        <form action="{{ route('struktur.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <x-ui.button type="input" title="Nama Lengkap" name="name" placeholder="Masukkan Nama Lengkap"
                        value="{{ old('name') }}" />
                </div>
                <div class="col-md-6">
                    <x-ui.button type="input" title="Gelar" name="title" placeholder="Masukkan Gelar"
                        value="{{ old('title') }}" />
                </div>
                <div class="col-md-6">
                    <x-ui.button type="input" title="Jabatan / Posisi" name="position_label"
                        placeholder="Masukkan Jabatan / Posisi" value="{{ old('position_label') }}" />
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Warna Background</label>
                        <div class="input-group">
                            <input type="color" name="bg_color"
                                class="form-control form-control-color @error('bg_color') is-invalid @enderror"
                                value="{{ old('bg_color', '#ffffff') }}">
                            <input type="text" id="bg_color_text" class="form-control"
                                value="{{ old('bg_color', '#ffffff') }}" placeholder="#ffffff" readonly>
                        </div>
                        @error('bg_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <x-ui.button type="input" title="Level Posisi" name="position_level"
                        placeholder="Masukkan Level Posisi" value="{{ old('position_level') }}" />
                </div>
                <div class="col-md-6">
                    <x-ui.button type="input" title="Urutan" name="order" placeholder="Masukkan Urutan"
                        value="{{ old('order') }}" />
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                            accept="image/*" onchange="previewImage(this)">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <img id="preview" src="#" alt="Preview" class="img-thumbnail d-none"
                                style="max-height:200px">
                        </div>
                    </div>
                </div>
            </div>

            <x-ui.button type="tombol" title="Simpan" icon="bi bi-save" />
            <x-ui.button type="link" url="{{ route('struktur.index') }}" title="Kembali" icon="bi bi-arrow-left"
                class="btn-outline-danger" />
        </form>
    </x-ui.card>
@endsection

@push('scripts')
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

        document.querySelector('input[name="bg_color"]').addEventListener('input', function() {
            document.getElementById('bg_color_text').value = this.value;
        });
    </script>
@endpush
