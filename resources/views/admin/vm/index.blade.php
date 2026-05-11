@extends('components.layouts.back.app', ['title' => 'Daftar Visi & Misi'])

@section('content')
    <x-ui.button type="link" url="{{ route('vm.create') }}" title="Tambah Visi/Misi" icon="bi bi-plus" />

    <x-ui.card title="Daftar Visi & Misi" icon="bi bi-list">
        <form action="{{ route('vm.index') }}" method="GET">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="q" value="{{ request('q') }}"
                        placeholder="Cari berdasarkan konten">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> CARI
                    </button>
                </div>
            </div>
        </form>

        <x-ui.table bordered>
            <thead>
                <tr>
                    <th style="text-align:center;width:6%">NO.</th>
                    <th>TIPE</th>
                    <th>KONTEN</th>
                    <th>URUTAN</th>
                    <th>STATUS</th>
                    <th style="width:15%;text-align:center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vms as $no => $vm)
                    <tr>
                        <th style="text-align:center">
                            {{ ++$no + ($vms->currentPage() - 1) * $vms->perPage() }}
                        </th>
                        <td>
                            <span class="badge {{ $vm->type === 'vision' ? 'bg-primary' : 'bg-success' }}">
                                {{ $vm->type === 'vision' ? 'Visi' : 'Misi' }}
                            </span>
                        </td>
                        <td>{!! Str::limit($vm->content, 80) !!}</td>
                        <td>{{ $vm->order }}</td>
                        <td>
                            <span class="badge {{ $vm->status ? 'bg-success' : 'bg-danger' }}">
                                {{ $vm->status ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <x-ui.button type="link" url="{{ route('vm.edit', $vm->id) }}" title="Edit"
                                icon="bi bi-pencil" />

                            <button onClick="Delete({{ $vm->id }})" class="btn btn-outline-danger mb-2">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-ui.table>

        <div style="text-align:center">
            {{ $vms->links('vendor.pagination.bootstrap-5') }}
        </div>
    </x-ui.card>
@endsection

@push('scripts')
    <script>
        function Delete(id) {
            var token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: 'Ingin menghapus data ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/vm/" + id,
                        data: {
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status == "success") {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Data berhasil dihapus!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                }).then(() => location.reload());
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: 'Data gagal dihapus!',
                                    icon: 'error'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan server!',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush
