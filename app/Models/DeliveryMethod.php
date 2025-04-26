<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMethod extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'estimated_days'];

    protected $appends = ['estimate_days_text'];

    public function getEstimateDaysTextAttribute()
    {
        if ($this->estimated_days === 0) {
            return 'Get it by today';
        } elseif ($this->estimated_days === 1) {
            return 'Get it by tomorrow';
        } else {
            $date = now()->addDays($this->estimated_days)->format('l, j M Y');
            return "Get it by $date";
        }
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
