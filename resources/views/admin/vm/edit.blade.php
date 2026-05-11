@extends('components.layouts.back.app', ['title' => 'Edit Visi & Misi'])

@section('content')
    <x-ui.card title="Edit Visi & Misi" icon="bi bi-pencil">
        <form action="{{ route('vm.update', $vm->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <x-ui.select name="type" title="Pilih Tipe">
                        <option disabled>-- Pilih Tipe --</option>
                        <option value="vision" {{ old('type', $vm->type) == 'vision' ? 'selected' : '' }}>Visi</option>
                        <option value="mission" {{ old('type', $vm->type) == 'mission' ? 'selected' : '' }}>Misi</option>
                    </x-ui.select>
                </div>
                <div class="col-md-3">
                    <x-ui.button type="input" title="Urutan" name="order" placeholder="Masukkan Urutan"
                        value="{{ old('order', $vm->order) }}" />
                </div>
                <div class="col-md-3">
                    <x-ui.select name="status" title="Pilih Status">
                        <option disabled>-- Pilih Status --</option>
                        <option value="1" {{ old('status', $vm->status) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('status', $vm->status) == 0 ? 'selected' : '' }}>Non Aktif</option>
                    </x-ui.select>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Konten</label>
                        <textarea name="content" class="form-control content" rows="5" placeholder="Masukkan Konten">{!! old('content', $vm->content) !!}</textarea>
                        @error('content')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
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
        tinymce.init({
            selector: "textarea.content",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
        });
    </script>
@endpush
