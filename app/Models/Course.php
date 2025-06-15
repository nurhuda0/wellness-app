<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'partner_id',
        'title',
        'coach',
        'age_group',
        'description',
        'start_time',
        'end_time',
        'capacity'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
