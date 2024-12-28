<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_name',
        'gross_amount',
        'courier',
        'transaction_status',
        'transaction_time',
        'snap_token'
    ];
}
