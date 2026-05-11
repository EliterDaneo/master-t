@props(['query'])

@php
    // Logika format nomor HP ke standar internasional (62)
    $phone = preg_replace('/^0/', '62', $query->no_hp);

    // Draft Pesan Otomatis
    $message = "Halo, Kak *{$query->nama}*! \n\n";
    $message .= "Kami dari tim admin ingin mengonfirmasi pesanan Anda: \n";
    $message .= "📌 *Project:* {$query->judul} \n";
    $message .= "🛠 *Layanan:* {$query->jenis_layanan} \n";
    $message .= '📊 *Status Saat Ini:* ' . strtoupper($query->status) . " \n\n";
    $message .= 'Pesan: ' . ($query->catatan_admin ?? 'Mohon tunggu informasi selanjutnya.');

    $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);
@endphp

<div class="d-flex gap-1">
    <!-- Tombol Hubungi via WhatsApp -->
    <a href="{{ $waUrl }}" target="_blank" class="btn btn-outline-success mb-2" title="Hubungi via WA">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Tombol Delete -->
    @if (Auth::user()->role === 'admin')
        <x-ui.button type="delete" id="{{ $query->id }}" url="{{ route('order.destroy', $query->id) }}"
            class="btn-sm" />
    @endif
</div>
