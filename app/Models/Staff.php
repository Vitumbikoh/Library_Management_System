<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'position', 'email', 'phone_number'
    ];

    public function libraryEvents()
    {
        return $this->hasMany(LibraryEvent::class);
    }
}
