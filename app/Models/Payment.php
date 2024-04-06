<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'paymentDate',
        'contract_id',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
