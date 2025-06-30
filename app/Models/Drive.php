<?php

namespace App\Models;

use App\Models\Family\Member;
use Illuminate\Database\Eloquent\Model;

class Drive extends Model
{
    protected $fillable = [
        'driver_id',
        'minutes',
        'date',
        'slot',
        'notes'
    ];

    public function driver()
    {
        return $this->belongsTo(Member::class);
    }
}
