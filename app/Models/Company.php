<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hr_email',
        'status',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
