<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = ['id'];

    public function schedules()
    {
        return $this->hasMany(UnitSchedule::class);
    }
}
