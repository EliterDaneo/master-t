<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'title',
    'position_label',
    'image',
    'bg_color',
    'position_level',
    'order',
])]
class Struktur extends Model
{
    //
}
