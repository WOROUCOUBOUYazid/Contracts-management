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
        'startDate',
        'endDate',
        'amount',
        'status',
        'file',
        'serviceProvider_id',
    ];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'serviceProvider_id');
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
