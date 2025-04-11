<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    protected $fillable = [
        'name',
        'type',
        'priority',
        'date',
        'note',
        'status',
    ];
}
