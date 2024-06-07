<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'amount',
        'status',
        'file',
        'service_provider_id',
    ];

    public function serviceProvider()
    {
        // return $this->belongsTo(ServiceProvider::class, 'service_provider_id');
        return $this->belongsTo(ServiceProvider::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
