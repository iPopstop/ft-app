<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = ['name', 'locale'];

    public function getLocaleWithNameAttribute()
    {
        return "{$this->name} ({$this->locale})";
    }

    public function scopeFilterByLocale($q, $locale = null)
    {
        if (!$locale) {
            return $q;
        }

        return $q->where('locale', $locale);
    }
}
