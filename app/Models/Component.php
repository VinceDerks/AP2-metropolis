<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    /** @use HasFactory<\Database\Factories\ComponentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'liveability',
        'well_being',
        'economic',
        'sustainability',
        'image_path'
    ];
}
