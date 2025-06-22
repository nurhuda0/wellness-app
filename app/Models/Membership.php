<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'billing_cycle',
        'duration_days',
        'features',
        'max_bookings_per_month',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('price');
    }

    // Helper methods
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    public function getBillingCycleTextAttribute()
    {
        return ucfirst($this->billing_cycle);
    }

    public function getDurationTextAttribute()
    {
        if ($this->duration_days == 30) {
            return '1 Month';
        } elseif ($this->duration_days == 90) {
            return '3 Months';
        } elseif ($this->duration_days == 365) {
            return '1 Year';
        } else {
            return $this->duration_days . ' Days';
        }
    }

    public function getFeaturesListAttribute()
    {
        return $this->features ?? [];
    }

    public function isPopular()
    {
        return $this->is_featured;
    }

    public function getActiveUsersCountAttribute()
    {
        return $this->users()->where('membership_expires_at', '>', now())->count();
    }

    // Static methods
    public static function getBillingCycles()
    {
        return [
            'monthly' => 'Monthly',
            'quarterly' => 'Quarterly',
            'yearly' => 'Yearly',
        ];
    }

    public static function getDefaultFeatures()
    {
        return [
            'Unlimited bookings',
            'Priority support',
            'Exclusive partner access',
            'Monthly wellness reports',
        ];
    }
}
