<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'rate',
        'message',
        'answer',
        'answered_at'
    ];

    protected $casts = [
        'rate' => 'int',
        'answered_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'id' => 0,
            'fio' => 'Аноним (без аккаунта)',
            'email' => null
        ]);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

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

    public function getAnsweredAtAttribute($value)
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

    public function scopeFilterByEmail($q, $email = null)
    {
        if (!$email) {
            return $q;
        }

        return $q->whereHas('user', function ($u) use ($email) {
            $u->where('email', 'LIKE', '%' . $email . '%');
        });
    }

    /**
     * @param $q
     * @param $dates
     * @return mixed
     */
    public function scopeCreatedAtDateBetween($q, $dates)
    {
        if ((!$dates['start_date'] || !$dates['end_date']) && $dates['start_date'] <= $dates['end_date']) {
            return $q;
        }

        return $q->where('created_at', '>=', getStartOfDate($dates['start_date']))->where('created_at', '<=', getEndOfDate($dates['end_date']));
    }
}
