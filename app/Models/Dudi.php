<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'bidang',
    'image',
    'link',
])]
class Dudi extends Model
{
    protected $casts = [
        'status' => 'boolean',
    ];
}
