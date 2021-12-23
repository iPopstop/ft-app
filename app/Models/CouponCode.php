<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
    protected $table = 'coupon_code';
    protected $fillable = [
        'user_id',
        'coupon_id',
        'is_active',
        'activated_at'
    ];

    protected $casts = [
        'is_active' => 'bool',
        'activated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
