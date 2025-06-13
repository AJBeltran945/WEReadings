<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Electric extends Model
{
    protected $table = 'electric'; // Table name

    protected $fillable = [
        'number',
        'date',
        'comment',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
