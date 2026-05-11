@props(['query'])

<div class="gap-2">
    <x-ui.button type="modal" :id="$query->id" icon="bi bi-pencil" title="" class="btn-outline-warning" />

    <x-ui.modal-edit :id="$query->id" title="Edit Data User" type="modal-xl">
        <form id="form-edit-user-{{ $query->id }}" action="{{ route('user.update', $query->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4 text-center border-right">
                    <div class="mb-3">
                        <label class="form-label d-block">Avatar</label>
                        <img src="{{ $query->avatar ? asset('storage/assets/back/img/avatar/' . $query->avatar) : asset('assets/back/img/avatar/avatar-1.png') }}"
                            alt="{{ $query->name }}" id="preview-{{ $query->id }}"
                            class="img-thumbnail rounded-circle mb-2"
                            style="width:150px; height:150px; object-fit:cover;">
                        <input type="file" name="avatar" class="form-control" accept="image/*"
                            onchange="previewEditImage(this, {{ $query->id }})">
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <x-ui.button type="input" title="Nama" name="name" value="{{ $query->name }}" />
                        </div>
                        <div class="col-md-6">
                            <x-ui.button type="input" title="Email" name="email" value="{{ $query->email }}" />
                        </div>
                        <div class="col-md-6">
                            <x-ui.select name="role" title="Role">
                                <option value="admin" {{ $query->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="writer" {{ $query->role == 'writer' ? 'selected' : '' }}>Writer</option>
                                <option value="user" {{ $query->role == 'user' ? 'selected' : '' }}>User</option>
                            </x-ui.select>
                        </div>
                        <div class="col-md-6">
                            <x-ui.button type="input" title="No. HP" name="phone" value="{{ $query->phone }}" />
                        </div>
                        <div class="col-md-6">
                            <x-ui.button type="input" title="Asal Sekolah" name="asal_sekolah"
                                value="{{ $query->asal_sekolah }}" />
                        </div>
                        <div class="col-md-6">
                            <x-ui.button type="input" title="Password (Kosongkan jika tidak diganti)" name="password"
                                type_input="password" />
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="address" class="form-control" rows="2">{{ $query->address }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer px-0 pb-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <x-ui.button type="tombol" icon="bi bi-save" title="Update User" class="btn btn-primary" />
            </div>
        </form>
    </x-ui.modal-edit>

    <x-ui.button type="delete" id="{{ $query->id }}" url="{{ route('user.destroy', $query->id) }}"
        class="btn-sm" />
</div>

@once
    @push('scripts')
        <script>
            function previewEditImage(input, id) {
                const preview = document.getElementById('preview-' + id);
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => preview.src = e.target.result;
                    reader.readAsDataURL(input.files[0]);
                }
            }
            // Inisialisasi Ajax untuk form edit yang dinamis
            $(document).on('shown.bs.modal', '.modal', function() {
                const formId = $(this).find('form').attr('id');
                if (formId && formId.startsWith('form-edit-user-')) {
                    AjaxCrudHelper.handleForm('#' + formId, '#user-table');
                }
            });
        </script>
    @endpush
@endonce
