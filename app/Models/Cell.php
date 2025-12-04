<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class Cell extends Model
{
    /** @use HasFactory<\Database\Factories\CellFactory> */
    use HasFactory;

    protected $fillable = [
        'x_coordinate',
        'y_coordinate',
        'grid_function_id',
        'grid_id',
    ];

    public function grid() : HasOne
    {
        return $this->hasOne(Grid::class);
    }
}
