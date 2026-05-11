<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'nama',
    'no_hp',
    'email',
    'jenis_layanan',
    'judul',
    'deskripsi',
    'status',
    'catatan_toko',
    'user_id',
])]
class Order extends Model
{
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
