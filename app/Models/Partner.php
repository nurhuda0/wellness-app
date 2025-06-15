<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'type',
        'city',
        'description',
        'status'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function checkIns()
    {
        return $this->hasMany(CheckIn::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
