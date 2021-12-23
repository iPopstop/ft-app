<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceHistory extends Model
{
    protected $table = 'balance_history';
    protected $typeFirst = 'refill';
    protected $typeSecond = 'withdrawal';

    protected $fillable = [
        'user_id',
        'type',
        'bonus',
        'sum',
        'company_id'
    ];

    protected $casts = [
        'type' => 'int',
        'sum' => 'float',
        'bonus' => 'bool'
    ];

    public function getTypeTextAttribute()
    {
        $text = $this->typeFirst;
        if ($this->type === 2) {
            $text = $this->typeSecond;
        }
        return $this->attributes['type_text'] = $text;
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
