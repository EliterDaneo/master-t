<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type', 'content', 'order', 'status'])]
class Vm extends Model
{
    protected $casts = [
        'status' => 'boolean',
    ];
}
