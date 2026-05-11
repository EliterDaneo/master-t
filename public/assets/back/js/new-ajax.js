$(document).ready(function () {
    // 1. Ketika Tahun Ajaran & Tingkat dipilih, load Kelas
    $('#tahun_ajaran, #tingkat').on('change', function () {
        const tahunAjaranId = $('#tahun_ajaran').val();
        const tingkat = $('#tingkat').val();

        // Reset dropdown berikutnya
        $('#kelas').html('<option disabled selected>Pilih Kelas</option>');
        $('#siswa').html('<option disabled selected>Pilih Nama Siswa</option>');

        if (tahunAjaranId && tingkat) {
            $.ajax({
                url: '/ptk/pelanggaran/get-kelas', // Sesuaikan dengan route Anda
                type: 'GET',
                data: {
                    tahun_ajaran_id: tahunAjaranId,
                    tingkat: tingkat
                },
                success: function (response) {
                    if (response.success && response.data.length > 0) {
                        $('#kelas').html(
                            '<option disabled selected>Pilih Kelas</option>');
                        response.data.forEach(function (kelas) {
                            $('#kelas').append(
                                `<option value="${kelas.kelas_id}">${kelas.kelas.nama_kelas}</option>`
                            );
                        });
                    } else {
                        $('#kelas').html(
                            '<option disabled selected>Tidak ada kelas tersedia</option>'
                        );
                    }
                },
                error: function (xhr) {
                    console.error('Error loading kelas:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data kelas'
                    });
                }
            });
        }
    });

    // 2. Ketika Kelas dipilih, load Siswa
    $('#kelas').on('change', function () {
        const kelasId = $(this).val();
        const tahunAjaranId = $('#tahun_ajaran').val();

        // Reset dropdown siswa
        $('#siswa').html('<option disabled selected>Pilih Nama Siswa</option>');

        if (kelasId && tahunAjaranId) {
            $.ajax({
                url: '/ptk/pelanggaran/get-siswa',
                type: 'GET',
                data: {
                    kelas_id: kelasId,
                    tahun_ajaran_id: tahunAjaranId
                },
                success: function (response) {

                    if (response.success && response.data.length > 0) {

                        $('#siswa').html('<option disabled selected>Pilih Nama Siswa</option>');

                        // LOOP DATA SISWA
                        response.data.forEach(function (siswa) {
                            $('#siswa').append(`
                            <option value="${siswa.id}">
                                ${siswa.nama_lengkap} - ${siswa.nisn.replace("'", "")}
                            </option>
                        `);
                        });

                    } else {
                        $('#siswa').html(
                            '<option disabled selected>Tidak ada siswa tersedia</option>'
                        );
                    }
                },
                error: function (xhr) {
                    console.error('Error loading siswa:', xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data siswa'
                    });
                }
            });
        }
    });

});