<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function offices()
    {
        return $this->belongsToMany(Office::class, 'currencies_offices', 'office_id', 'currency_id');
    }
}
