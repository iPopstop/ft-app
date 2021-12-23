<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mobile_number',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'email_verified_at',
        'balance',
        'age',
        'referral_code',
        'referral_id',
        'locale_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'balance' => 'float',
        'email_verified_at' => 'datetime',
        'age' => 'int'
    ];

    protected $appends = ['fio'];

    public function tips()
    {
        return $this->hasMany(Tip::class);
    }

    public function history()
    {
        return $this->hasMany(BalanceHistory::class);
    }

    public function getFioAttribute()
    {
        return trim("{$this->last_name} {$this->first_name} {$this->middle_name}");
    }

    public function scopeFilterByEmail($q, $email = null)
    {
        if (!$email) {
            return $q;
        }

        return $q->where('email', $email);
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

    /**
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return "user.{$this->id}";
    }
}
