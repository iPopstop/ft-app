<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'enabled',
        'address',
        'costs',
        'val',
        'email',
        'mobile_number',
        'theme'
    ];

    protected $casts = [
        'enabled' => 'bool',
        'costs' => 'bool',
        'theme' => 'array'
    ];

    public function setMobileNumberAttribute($value)
    {
        return $this->attributes['mobile_number'] = $value ? preg_replace("/\D/u", "", trim($value)) : '';
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
