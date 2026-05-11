@extends('components.layouts.back.app', ['title' => 'Daftar Kategori Tefa'])

@section('content')
    <x-ui.button type="link" url="{{ route('berita.create') }}" title="Tambah Berita" icon="bi bi-plus" />

    <x-ui.card title="Daftar Kategori" icon="bi bi-list">
        <form action="{{ route('berita.index') }}" method="GET">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="q" placeholder="cari berdasarkan judul berita">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <x-ui.table bordered>
            <thead>
                <tr>
                    <th scope="col" style="text-align: center;width: 6%">NO.</th>
                    <th scope="col">JUDUL BERITA</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col">KONTEN</th>
                    <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $no => $post)
                    <tr>
                        <th scope="row" style="text-align: center">
                            {{ ++$no + ($posts->currentPage() - 1) * $posts->perPage() }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>{!! $post->content !!}</td>
                        <td class="text-center">
                            <x-ui.button type="link" url="{{ route('berita.edit', $post->slug) }}" title="Edit"
                                icon="bi bi-pencil" />

                            <button onClick="Delete(this.id)" class="btn btn-outline-danger mb-2" id="{{ $post->id }}">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-ui.table>
        <div style="text-align: center">
            {{ $posts->links('vendor.pagination.bootstrap-5') }}
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
                        url: "/admin/berita/" + id,
                        data: {
                            "id": id,
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
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                }).then(() => location.reload());
                            }
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan server!',
                                icon: 'error',
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush
