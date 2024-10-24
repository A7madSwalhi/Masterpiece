<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id', 'user_id', 'payment_method', 'status', 'payment_status','invoice_no',
        'shipping','tax','discount','total','coupon','confirmed_date',
        'processing_date','shipped_date','delivered_date','cancel_date','refunded_date',
        'refunded_reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest Customer'
        ]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id', 'id', 'id')
            ->using(OrderItem::class)
            ->as('order_item')
            ->withPivot([
                'product_name', 'price', 'quantity', 'options','vendor_id'
            ]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function addresses()
    {
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'billing');

        //return $this->addresses()->where('type', '=', 'billing');
    }

    public function shippingAddress()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id')
            ->where('type', '=', 'shipping');
    }


    protected static function booted()
    {
        static::creating(function(Order $order) {
            // 20220001, 20220002
            $order->invoice_no = Order::getNextOrderNumber();
        });
    }

    public static function getNextOrderNumber()
    {
        // SELECT MAX(number) FROM orders
        $year =  Carbon::now()->year;
        $number = Order::whereYear('created_at', $year)->max('invoice_no');
        if ($number) {
            return $number + 1;
        }
        return $year . '0001';
    }
}
