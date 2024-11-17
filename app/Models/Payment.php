<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'order_id',
        'currency',
        'method',
        'status',
        'transaction_id',
        'transaction_data',

    ];


    public function payment(){
        return $this->belongsTo(Order::class,'order_id','id');
    }


}
