<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'company_id',
        'type',
        'min_sum',
        'description',
        'sale',
        'is_enabled',
        'price_total',
        'price_company',
    ];

    protected $casts = [
        'price_total' => 'float',
        'price_company' => 'float',
        'is_enabled' => 'bool',
        'min_sum' => 'integer',
        'sale' => 'float'
    ];

    protected $appends = ['type_string'];

    public function getTypeStringAttribute()
    {
        return sprintf("Скидка -%s %s", $this->sale, $this->type === 1 ? ' руб.' : '%');
    }

    public function codes()
    {
        return $this->hasMany(CouponCode::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
