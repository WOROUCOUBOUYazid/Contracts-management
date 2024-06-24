<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ressource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'http_method',
        'uri',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'ressource_role');
    }
}
