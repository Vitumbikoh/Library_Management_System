<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Added for user role (admin/user)
        'address', // Added for user's address
        'phone_number', // Added for user's phone number
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * User has many loans.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * User has many reservations.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * User has many payments.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * A user can borrow many books.
     */
    public function borrowedBooks()
    {
        return $this->belongsToMany(Book::class, 'loans')->withPivot('loan_date', 'return_date');
    }

    /**
     * A user can reserve many books.
     */
    public function reservedBooks()
    {
        return $this->belongsToMany(Book::class, 'reservations')->withPivot('reservation_date', 'status');
    }
}
