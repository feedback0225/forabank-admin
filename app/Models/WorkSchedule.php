<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['type_of_client_id', 'schedule', 'office_id'];

    public function typeOfClient() {
        return $this->belongsTo(TypeOfClient::class);
    }

    public function office() {
        return $this->belongsTo(Office::class);
    }
}
