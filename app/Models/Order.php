<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
        'status',
        'session_id',
        'user_address_id',
        'created_by',
        'updated_by',
        'delivery_method_id',
    ];

    function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function delivery_method()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }
}
