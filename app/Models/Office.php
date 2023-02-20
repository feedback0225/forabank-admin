<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    public function city() {
        return $this->hasOne(City::class);
    }

    public function currencies() {
        return $this->belongsToMany(Currency::class, 'currencies_offices', 'currency_id', 'office_id');
    }

    public function workSchedules() {
        return $this->hasMany(WorkSchedule::class);
    }
}
