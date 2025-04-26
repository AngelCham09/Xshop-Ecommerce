<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'address1',
        'address2',
        'city',
        'state',
        'postcode',
        'isMain',
        'country_code',
        'user_id'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
