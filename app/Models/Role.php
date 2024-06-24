<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function ressources(): BelongsToMany
    {
        return $this->belongsToMany(Ressource::class);
    }
}
