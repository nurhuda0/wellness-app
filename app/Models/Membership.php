<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'name',
        'price',
        'features',
        'duration_months'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
