<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circulation extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class); // Assuming you have a Book model
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }
}
