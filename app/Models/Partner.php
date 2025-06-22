<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'city',
        'description',
        'address',
        'phone',
        'email',
        'website',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Partner types constants
    const TYPE_GYM = 'gym';
    const TYPE_SPORTS_CLUB = 'sports_club';
    const TYPE_SPA = 'spa';
    const TYPE_WELLNESS_CENTER = 'wellness_center';

    public static function getTypes()
    {
        return [
            self::TYPE_GYM => 'Gym',
            self::TYPE_SPORTS_CLUB => 'Sports Club',
            self::TYPE_SPA => 'Spa',
            self::TYPE_WELLNESS_CENTER => 'Wellness Center',
        ];
    }
}
