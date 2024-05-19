<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
       'position_name',
       'maximum_selections',
       'started_at',
       'ended_at',
        'is_active',
    ];
}
