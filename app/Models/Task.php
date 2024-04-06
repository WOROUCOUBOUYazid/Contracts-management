<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'startDate',
        'endDate',
        'contract_id',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
