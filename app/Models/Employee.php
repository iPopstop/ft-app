<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;

    protected $fillable = [
        'mobile_number',
        'first_name',
        'middle_name',
        'last_name',
        'company_id',
        'position_id',
        'balance',
        'tips_enabled'
    ];

    protected $casts = [
        'balance' => 'float',
        'tips_enabled' => 'bool'
    ];

    protected $appends = ['fio', 'fi'];

    protected $with = ['position'];

    public function setMobileNumberAttribute($value)
    {
        return $this->attributes['mobile_number'] = $value ? preg_replace("/\D/u", "", trim($value)) : '';
    }

    public function getAvgTipsAttribute()
    {
        if (!$this->relationLoaded('tips')) {
            $this->load('tips');
        }
        return $this->attributes['avg_tips'] = number_format($this->tips->avg('sum_tips') ?? 0, 2);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tips()
    {
        return $this->hasMany(Tip::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class)->withDefault([
            'id' => null,
            'name' => trans('user.no_position')
        ]);
    }

    public function getFioAttribute()
    {
        return $this->attributes['fio'] = trim("{$this->last_name} {$this->first_name} {$this->middle_name}");
    }

    public function getFiAttribute()
    {
        return $this->attributes['fi'] = trim("{$this->last_name} {$this->first_name}");
    }

    public function scopeFilterByEmail($q, $email = null)
    {
        if (!$email) {
            return $q;
        }

        return $q->where('email', $email);
    }

    public function scopeFilterByNumber($q, $number = null)
    {
        if (!$number) {
            return $q;
        }

        return $q->where('mobile_number', $number);
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

    // Задел на будущее
    public function receivesBroadcastNotificationsOn()
    {
        return "user.tips.{$this->id}";
    }
}
