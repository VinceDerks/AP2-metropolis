<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    /** @use HasFactory<\code\database\factories\PermissionFactory> */
    use HasFactory;

    protected $guarded = [
        'name',
        'system_name',
    ];

    public function roles(): belongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
