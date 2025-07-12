<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Water extends Model
{
    protected $table = 'water'; // Table name

    protected $fillable = [
        'number',
        'date',
        'comment',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
