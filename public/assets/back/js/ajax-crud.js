window.AjaxCrudHelper = (function () {

    // Helper untuk menampilkan alert loading
    const showLoading = (title = 'Memproses...') => {
        Swal.fire({
            title,
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });
    };

    // Helper untuk alert sukses
    const showSuccess = (message = 'Berhasil!') => {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            timer: 1500,
            showConfirmButton: false
        });
    };

    // Helper untuk alert error
    const showError = (message = 'Terjadi kesalahan!') => {
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: message
        });
    };

    // ==============================================
    // Handle Form Create / Edit
    // ==============================================
    const handleForm = function (selector, tableSelector = null, hideModal = true) {
        $(document).on('submit', selector, function (e) {
            e.preventDefault();

            let form = $(this);
            let formData = new FormData(this);
            let url = form.attr('action');

            form.find('button[type=submit], .btn[data-bs-dismiss="modal"]').prop('disabled', true);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    showLoading('Menyimpan data...');
                },
                success: function (response) {
                    showSuccess(response.message || 'Data berhasil disimpan.');

                    if (hideModal) {
                        form.closest('.modal').modal('hide');
                    }

                    form[0].reset();

                    if (tableSelector && $.fn.DataTable.isDataTable(tableSelector)) {
                        $(tableSelector).DataTable().ajax.reload(null, false);
                    }
                },
                error: function (xhr) {
                    const res = xhr.responseJSON;
                    showError(res?.message || 'Terjadi kesalahan saat menyimpan data.');
                },
                complete: function () {
                    form.find('button[type=submit], .btn[data-bs-dismiss="modal"]').prop('disabled', false);
                }
            });
        });
    };

    // ==============================================
    // Handle Delete
    // ==============================================
    const handleDelete = function (selector, tableSelector = null) {
        $(document).on('click', selector, function (e) {
            e.preventDefault();

            const btn = $(this);
            const url = btn.data('url') || btn.attr('href');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading('Menghapus data...');

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: { _token: $('meta[name="csrf-token"]').attr('content') },
                        success: function (response) {
                            showSuccess(response.message || 'Data berhasil dihapus.');

                            if (tableSelector && $.fn.DataTable.isDataTable(tableSelector)) {
                                $(tableSelector).DataTable().ajax.reload(null, false);
                            }
                        },
                        error: function (xhr) {
                            showError(xhr.responseJSON?.message || 'Gagal menghapus data.');
                        }
                    });
                }
            });
        });
    };

    // ==============================================
    // Handle Daftar Ulang
    // ==============================================
    function handleDU(selector, tableSelector = null) {
        $(document).on('click', selector, function (e) {
            e.preventDefault();

            const btn = $(this);
            const url = btn.data('url');
            const method = btn.data('method') || 'PUT';
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            if (!url) {
                Swal.fire({
                    icon: 'error',
                    title: 'URL tidak ditemukan!',
                    text: 'Pastikan tombol memiliki atribut data-url.',
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi Daftar Ulang',
                html: `
                <p>Apakah Anda yakin ingin mengubah status menjadi <strong>Daftar Ulang</strong>?</p>
                <small class="text-muted">Tindakan ini tidak dapat diubah kembali.</small>
            `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, ubah sekarang',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading(),
                    });

                    $.ajax({
                        url: url,
                        type: method,
                        data: { _token: csrfToken },
                        success: function (response) {
                            Swal.fire({
                                icon: response.success ? 'success' : 'info',
                                title: response.success ? 'Berhasil' : 'Perhatian',
                                text: response.message || 'Status berhasil diperbarui',
                                timer: 1800,
                                showConfirmButton: false
                            });

                            // Jika ada DataTable, reload tanpa reset pagination
                            if (tableSelector && $.fn.DataTable.isDataTable(tableSelector)) {
                                $(tableSelector).DataTable().ajax.reload(null, false);
                            }
                        },
                        error: function (xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan saat memperbarui status.'
                            });
                        }
                    });
                }
            });
        });
    };

    // ==============================================
    // Handle Form Seleksi
    // ==============================================
    const handleSeleksi = function (selector, tableSelector = null, hideModal = true) {
        $(document).on('submit', selector, function (e) {
            e.preventDefault();

            let form = $(this);
            let formData = new FormData(this);
            let url = form.attr('action');

            form.find('button[type=submit], .btn[data-bs-dismiss="modal"]').prop('disabled', true);

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    showLoading('Menyimpan data seleksi...');
                },
                success: function (response) {
                    showSuccess(response.message || 'Data berhasil disimpan.');

                    if (hideModal) {
                        form.closest('.modal').modal('hide');
                    }

                    form[0].reset();

                    if (tableSelector && $.fn.DataTable.isDataTable(tableSelector)) {
                        $(tableSelector).DataTable().ajax.reload(null, false);
                    }
                },
                error: function (xhr) {
                    const res = xhr.responseJSON;
                    showError(res?.message || 'Terjadi kesalahan saat menyimpan data.');
                },
                complete: function () {
                    form.find('button[type=submit], .btn[data-bs-dismiss="modal"]').prop('disabled', false);
                }
            });
        });
    };

    // ==============================================
    // Handle Formulir Download
    // ==============================================
    function handleFormulirDownload(selector) {
        // Pastikan jQuery sudah dimuat
        if (typeof jQuery === 'undefined') {
            console.error('jQuery not loaded. handleFormulirDownload aborted.');
            return;
        }

        // Gunakan event delegation pada selector yang diberikan
        $(document).on('click', selector, function (e) {
            e.preventDefault();

            // Log untuk debugging
            console.log('>>> Formulir Download Button clicked!');

            const btn = $(this);
            const url = btn.data('url');
            const id = btn.data('id');
            const title = btn.data('title') || 'Formulir Pendaftaran';

            if (url === '#' || !id) {
                Swal.fire({
                    icon: 'error',
                    title: 'Data Tidak Lengkap',
                    text: 'ID siswa tidak ditemukan.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            const now = new Date();
            const formattedDate = now.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            Swal.fire({
                title: 'Konfirmasi Download Formulir',
                html: `
                <p>Apakah Anda yakin ingin mengunduh formulir pendaftaran <strong>${title}</strong>?</p>
                <ul style="text-align:left; margin-top:10px; list-style-position: inside;">
                    <li><strong>ID Siswa:</strong> ${id}</li>
                    <li><strong>Format File:</strong> PDF</li>
                    <li><strong>Tanggal:</strong> ${formattedDate}</li>
                </ul>
            `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-download"></i> Ya, Download Sekarang',
                cancelButtonText: '<i class="fas fa-times"></i> Batal',
                confirmButtonColor: '#d33', // Merah untuk download
                cancelButtonColor: '#3085d6',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading saat menunggu file di-generate server
                    Swal.fire({
                        title: 'Menyiapkan Formulir...',
                        text: 'Mohon tunggu, sedang memproses file PDF.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Arahkan browser ke URL download
                    window.location.href = url;

                    // Tutup SweetAlert loading dan tampilkan success message setelah delay
                    // Delay 1 detik untuk memberi waktu browser memulai download
                    setTimeout(() => {
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Download Dimulai!',
                            text: 'File PDF sedang diunduh oleh browser Anda.',
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    }, 1000);
                }
            });
        });
    };

    // ==============================================
    // Handle Delete
    // ==============================================
    const handleArsip = function (selector, tableSelector = null) {
        $(document).on('click', selector, function (e) {
            e.preventDefault();

            const btn = $(this);
            const url = btn.data('url') || btn.attr('href');
            // Ambil nama dari data-nama agar fleksibel untuk tiap baris
            const nama = btn.data('nama') || 'Data ini';

            Swal.fire({
                icon: 'warning',
                title: 'Arsipkan?',
                html: `<b>${nama}</b> akan dipindahkan ke arsip.`,
                showCancelButton: true,
                confirmButtonColor: '#f59e0b',
                confirmButtonText: 'Arsipkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Pastikan fungsi showLoading sudah didefinisikan sebelumnya
                    if (typeof showLoading === 'function') showLoading('Mengarsipkan data...');

                    $.ajax({
                        url: url,
                        type: 'PATCH', // Perbaikan: PATCH (bukan PACTH)
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            if (typeof showSuccess === 'function') {
                                showSuccess(response.message || 'Data berhasil diarsipkan.');
                            }

                            if (tableSelector && $.fn.DataTable.isDataTable(tableSelector)) {
                                $(tableSelector).DataTable().ajax.reload(null, false);
                            }
                        },
                        error: function (xhr) {
                            if (typeof showError === 'function') {
                                showError(xhr.responseJSON?.message || 'Gagal mengarsipkan data.');
                            }
                        }
                    });
                }
            });
        });
    };

    // Public API
    return {
        handleForm,
        handleDelete,
        handleDU,
        handleSeleksi,
        handleFormulirDownload,
        handleArsip,
    };
})();
