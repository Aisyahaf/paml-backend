<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'opsi',
        'tgl_msk',
        'tgl_klr',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id');
    }
}
