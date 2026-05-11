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

    // Public API
    return {
        handleForm,
        handleDelete,
    };
})();
