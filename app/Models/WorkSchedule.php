<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSchedule extends Model
{
    use HasFactory;

    public function typeOfClient() {
        return $this->hasOne(TypeOfClient::class);
    }

    public function office() {
        return $this->hasOne(Office::class);
    }
}
