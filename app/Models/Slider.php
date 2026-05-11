<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'status', 'image'])]
class Slider extends Model
{
    protected $casts = [
        'status' => 'boolean',
    ];
}
