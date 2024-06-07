<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'birth_date',
        'birth_place',
        // 'nationality',
        'residence_place',
        'marital_status',
        'children_number',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contracts()
    {
        // return $this->hasMany(Contract::class, 'service_provider_id');
        return $this->hasMany(Contract::class);
    }
}
