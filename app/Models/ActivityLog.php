<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'action',
        'description',
        'created_at',
    ];

    public $timestamps = false; // No timestamps, since we manually handle created_at

    // Cast the created_at attribute to a Carbon instance
    protected $casts = [
        'created_at' => 'datetime', // Ensure created_at is cast to a Carbon instance
    ];
}
