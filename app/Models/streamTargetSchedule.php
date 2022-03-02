<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class streamTargetSchedule extends Model
{
    use HasFactory;
    protected $fillable=['app','stream','start_time','end_time','status'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}
