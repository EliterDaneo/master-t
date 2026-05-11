document.addEventListener('DOMContentLoaded', function () {
    const btnGoLast = document.getElementById('btnGoLast');

    btnGoLast?.addEventListener('click', function () {
        // Ambil URL dari data attribute yang kita buat di Blade
        const targetUrl = this.getAttribute('data-url');

        Swal.fire({
            icon: 'question',
            title: 'Kembali ke Dashboard?',
            text: 'Anda akan diarahkan ke halaman utama dashboard',
            showCancelButton: true,
            confirmButtonText: 'Ya, arahkan saya',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#4f46e5', // Sesuaikan dengan warna tema Indigo tadi
            cancelButtonColor: '#94a3b8',
            reverseButtons: true // Opsional: menukar posisi tombol agar 'Ya' di kanan
        }).then((result) => {
            if (result.isConfirmed && targetUrl !== '#') {
                window.location.href = targetUrl;
            }
        });
    });
});