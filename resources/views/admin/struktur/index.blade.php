@extends('components.layouts.back.app', ['title' => 'Daftar Struktur'])

@section('content')
    <x-ui.button type="link" url="{{ route('struktur.create') }}" title="Tambah Struktur" icon="bi bi-plus" />

    <x-ui.card title="Daftar Struktur" icon="bi bi-list">
        <form action="{{ route('struktur.index') }}" method="GET">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="q" value="{{ request('q') }}"
                        placeholder="Cari berdasarkan nama">
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
                    <th>NAMA</th>
                    <th>JABATAN</th>
                    <th>LEVEL</th>
                    <th>URUTAN</th>
                    <th style="width:15%;text-align:center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($strukturs as $no => $struktur)
                    <tr>
                        <th style="text-align:center">
                            {{ ++$no + ($strukturs->currentPage() - 1) * $strukturs->perPage() }}
                        </th>
                        <td>{{ $struktur->name }}</td>
                        <td>{{ $struktur->position_label }}</td>
                        <td>{{ $struktur->position_level }}</td>
                        <td>{{ $struktur->order }}</td>
                        <td class="text-center">
                            <x-ui.button type="link" url="{{ route('struktur.edit', $struktur->id) }}" title="Edit"
                                icon="bi bi-pencil" />

                            <button onClick="Delete({{ $struktur->id }})" class="btn btn-outline-danger mb-2">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-ui.table>

        <div style="text-align:center">
            {{ $strukturs->links('vendor.pagination.bootstrap-5') }}
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
                        url: "/admin/struktur/" + id,
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
