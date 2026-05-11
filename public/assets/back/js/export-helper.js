const ExportHelper = {
    /**
     * Handle export form with AJAX (no page reload)
     * @param {string} formSelector - Form selector
     * @param {object} options - Configuration options
     */
    handleExportForm: function (formSelector, options = {}) {
        const defaults = {
            showPreview: true,
            autoDownload: true,
            fileName: 'export.pdf',
            beforeExport: null,
            afterExport: null,
            onError: null
        };

        const config = { ...defaults, ...options };

        $(document).on('submit', formSelector, function (e) {
            e.preventDefault();

            let form = $(this);
            let formData = form.serialize();
            let url = form.attr('action');

            // Disable form inputs
            form.find('button, input, select').prop('disabled', true);

            // Call before export callback
            if (typeof config.beforeExport === 'function') {
                config.beforeExport(form);
            }

            $.ajax({
                url: url,
                method: 'GET',
                data: formData,
                xhrFields: {
                    responseType: 'blob'
                },
                beforeSend: function () {
                    ExportHelper._showLoading('Memproses export...');
                },
                success: function (blob, status, xhr) {
                    Swal.close();

                    if (config.autoDownload) {
                        ExportHelper._downloadBlob(blob, xhr, config.fileName);
                        ExportHelper._showSuccess('File berhasil didownload!');
                    }

                    // Call after export callback
                    if (typeof config.afterExport === 'function') {
                        config.afterExport(blob, xhr);
                    }
                },
                error: function (xhr) {
                    Swal.close();

                    let errorMessage = 'Gagal melakukan export';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        try {
                            const reader = new FileReader();
                            reader.onload = function () {
                                const error = JSON.parse(reader.result);
                                errorMessage = error.message || errorMessage;
                            };
                            reader.readAsText(xhr.responseText);
                        } catch (e) {
                            // Keep default error message
                        }
                    }

                    if (typeof config.onError === 'function') {
                        config.onError(xhr, errorMessage);
                    } else {
                        ExportHelper._showError(errorMessage);
                    }
                },
                complete: function () {
                    form.find('button, input, select').prop('disabled', false);
                }
            });
        });
    },

    /**
     * Handle preview button
     * @param {string} buttonSelector - Button selector
     * @param {string} formSelector - Related form selector
     */
    handlePreview: function (buttonSelector, formSelector) {
        $(document).on('click', buttonSelector, function (e) {
            e.preventDefault();

            let form = $(formSelector);
            let formData = form.serialize();
            let url = form.attr('action');

            // Add preview parameter
            const separator = url.includes('?') ? '&' : '?';
            const previewUrl = `${url}${separator}${formData}&preview=1`;

            window.open(previewUrl, '_blank');
        });
    },

    /**
     * Direct download without form
     * @param {string} url - Download URL
     * @param {object} params - URL parameters
     * @param {string} fileName - File name
     */
    download: function (url, params = {}, fileName = 'download.pdf') {
        const queryString = $.param(params);
        const fullUrl = queryString ? `${url}?${queryString}` : url;

        $.ajax({
            url: fullUrl,
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            beforeSend: function () {
                ExportHelper._showLoading('Mendownload file...');
            },
            success: function (blob, status, xhr) {
                Swal.close();
                ExportHelper._downloadBlob(blob, xhr, fileName);
                ExportHelper._showSuccess('File berhasil didownload!');
            },
            error: function (xhr) {
                Swal.close();
                ExportHelper._showError('Gagal mendownload file');
            }
        });
    },

    /**
     * Export with confirmation
     * @param {string} url - Export URL
     * @param {object} params - Parameters
     * @param {object} options - Confirmation options
     */
    downloadWithConfirm: function (url, params = {}, options = {}) {
        const defaults = {
            title: 'Export Data?',
            text: 'Apakah Anda yakin ingin mengexport data ini?',
            icon: 'question',
            confirmButtonText: 'Ya, Export!',
            cancelButtonText: 'Batal',
            fileName: 'export.pdf'
        };

        const config = { ...defaults, ...options };

        Swal.fire({
            title: config.title,
            text: config.text,
            icon: config.icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: config.confirmButtonText,
            cancelButtonText: config.cancelButtonText
        }).then((result) => {
            if (result.isConfirmed) {
                ExportHelper.download(url, params, config.fileName);
            }
        });
    },

    /**
     * Private: Download blob as file
     */
    _downloadBlob: function (blob, xhr, defaultFileName) {
        // Get filename from header or use default
        const disposition = xhr.getResponseHeader('Content-Disposition');
        let filename = defaultFileName;

        if (disposition && disposition.indexOf('filename=') !== -1) {
            const matches = disposition.match(/filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/);
            if (matches != null && matches[1]) {
                filename = matches[1].replace(/['"]/g, '');
            }
        }

        // Create download link
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);
    },

    /**
     * Private: Show loading
     */
    _showLoading: function (message) {
        Swal.fire({
            title: 'Memproses...',
            text: message,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    },

    /**
     * Private: Show success message
     */
    _showSuccess: function (message) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            timer: 2000,
            showConfirmButton: false
        });
    },

    /**
     * Private: Show error message
     */
    _showError: function (message) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message,
            confirmButtonText: 'OK'
        });
    }
};

// Make it available globally
window.ExportHelper = ExportHelper;