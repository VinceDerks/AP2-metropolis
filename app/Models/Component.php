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
        'safety',
        'recreation',
        'environment',
        'provision',
        'mobility',
        'image_path',
        'category_id'
    ];
}
