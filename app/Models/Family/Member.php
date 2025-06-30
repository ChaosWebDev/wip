<?php

namespace App\Models\Family;

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
}
