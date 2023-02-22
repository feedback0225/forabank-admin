<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfClient extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function workSchedules() {
        return $this->hasMany(WorkSchedule::class);
    }
}
