<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = ['city_id', 'name', 'address', 'lat', 'lng', 'is_active', 'phone', 'email'];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function currencies() {
        return $this->belongsToMany(Currency::class, 'currencies_offices', 'office_id', 'currency_id');
    }

    public function workSchedules() {
        return $this->hasMany(WorkSchedule::class);
    }
}
