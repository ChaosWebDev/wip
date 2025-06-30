<?php

namespace App\Models\Family;

use App\Models\Drive;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'dob',
        'sex',
    ];

    protected $casts = [
        'dob' => 'date'
    ];

    public function getTotalDayHoursAttribute()
    {
        $minutes = Drive::where('driver_id', $this->id)
            ->where('slot', '=', 'day', 'and')
            ->pluck('minutes')
            ->toArray();
        return array_sum($minutes) / 60;
    }

    public function getTotalNightHoursAttribute()
    {
        $minutes = Drive::where('driver_id', $this->id)
            ->where('slot', '=', 'night', 'and')
            ->pluck('minutes')
            ->toArray();
        return array_sum($minutes) / 60;
    }

    public function drives()
    {
        return $this->hasMany(Drive::class, 'driver_id');
    }
}
