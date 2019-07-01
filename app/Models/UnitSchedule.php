<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitSchedule extends Model
{
    protected $guarded = ['id'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
