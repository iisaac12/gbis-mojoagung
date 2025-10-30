<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'time_start',
        'time_end',
        'location',
        'description',
        'language'
    ];

    protected $casts = [
        'date' => 'date',
        'time_start' => 'datetime',
        'time_end' => 'datetime',
    ];
}