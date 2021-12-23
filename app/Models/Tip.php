<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Tip extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'sum_tips',
        'sum_commission',
        'comment_id',
        'commission_payed',
    ];

    protected $casts = [
        'sum_tips' => 'float',
        'sum_commission' => 'float',
        'commission_payed' => 'bool'
    ];

    public function getCreatedAtAttribute($value)
    {
        if (!$value) {
            return '-';
        }
        try {
            return Carbon::parse($value)->format('d.m.Y H:i');
        } catch (\Exception $e) {
            return '-';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'id' => null,
            'first_name' => trans('auth.anonim'),
            'last_name' => trans('auth.anonim'),
            'middle_name' => ''
        ]);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }
}
