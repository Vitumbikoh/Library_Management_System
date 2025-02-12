<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name', 'date', 'location', 'description'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
