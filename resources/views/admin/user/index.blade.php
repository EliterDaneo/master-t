@extends('components.layouts.back.app', ['title' => 'Daftar User'])

@section('content')
    <div class="row">
        <div class="col-md-4">
            <x-ui.card title="Form Tambah User" icon="bi bi-person-plus">
                <form id="form-user" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-2 mb-2 text-center">
                        <img id="preview" src="#" alt="Preview" class="img-thumbnail d-none rounded-circle"
                            style="width:120px; height:120px; object-fit:cover;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Avatar</label>
                        <input type="file" name="avatar" class="form-control" accept="image/*"
                            onchange="previewImage(this)">
                    </div>

                    <x-ui.button type="input" title="Nama Lengkap" name="name" placeholder="Masukkan nama" />
                    <x-ui.button type="input" title="Email" name="email" type_input="email"
                        placeholder="email@example.com" />
                    <x-ui.button type="input" title="Password" name="password" type_input="password"
                        placeholder="******" />

                    <div class="row">
                        <div class="col-md-6">
                            <x-ui.select name="role" title="Role">
                                <option value="user" selected>User</option>
                                <option value="writer">Writer</option>
                                <option value="admin">Admin</option>
                            </x-ui.select>
                        </div>
                        <div class="col-md-6">
                            <x-ui.button type="input" title="No. HP" name="phone" placeholder="0812..." />
                        </div>
                    </div>

                    <x-ui.button type="input" title="Asal Sekolah" name="asal_sekolah" placeholder="Nama sekolah" />

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="2" placeholder="Alamat lengkap"></textarea>
                    </div>

                    <x-ui.button type="tombol" title="Simpan User" icon="bi bi-save" class="w-100 btn-primary" />
                </form>
            </x-ui.card>
        </div>

        <div class="col-md-8">
            <x-ui.card title="Data Master User" icon="bi bi-people">
                {{ $dataTable->table(['width' => '100%', 'class' => 'table table-striped']) }}
            </x-ui.card>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

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

        $(function() {
            AjaxCrudHelper.handleForm('#form-user', '#user-table');
            AjaxCrudHelper.handleForm('[id^="form-edit-user-"]', '#user-table');
            AjaxCrudHelper.handleDelete('.btn-delete', '#user-table');
        });
    </script>
@endpush
