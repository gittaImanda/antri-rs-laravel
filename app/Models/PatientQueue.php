<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PatientQueue extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function unitSchedule()
    {
        return $this->belongsTo(UnitSchedule::class);
    }
}
