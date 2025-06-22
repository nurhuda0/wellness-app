<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_EMPLOYEE = 'employee';
    const ROLE_HR_ADMIN = 'hr_admin';
    const ROLE_SUPER_ADMIN = 'super_admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'company_id',
        'membership_id',
        'membership_expires_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'membership_expires_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role === self::ROLE_HR_ADMIN || $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isSuperAdmin()
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function checkIns()
    {
        return $this->hasMany(CheckIn::class);
    }

    // Membership helper methods
    public function hasActiveMembership()
    {
        return $this->membership_id && 
               $this->membership_expires_at && 
               $this->membership_expires_at->isFuture();
    }

    public function getMembershipStatusAttribute()
    {
        if (!$this->membership_id) {
            return 'No Membership';
        }

        if (!$this->membership_expires_at) {
            return 'Active';
        }

        if ($this->membership_expires_at->isFuture()) {
            return 'Active';
        }

        return 'Expired';
    }

    public function getMembershipDaysLeftAttribute()
    {
        if (!$this->membership_expires_at || $this->membership_expires_at->isPast()) {
            return 0;
        }

        return now()->diffInDays($this->membership_expires_at, false);
    }

    public function canMakeBooking()
    {
        if (!$this->hasActiveMembership()) {
            return false;
        }

        // Check if user has exceeded monthly booking limit
        $monthlyBookings = $this->bookings()
            ->where('created_at', '>=', now()->startOfMonth())
            ->count();

        return $monthlyBookings < $this->membership->max_bookings_per_month;
    }

    public function getRemainingBookingsAttribute()
    {
        if (!$this->hasActiveMembership()) {
            return 0;
        }

        $monthlyBookings = $this->bookings()
            ->where('created_at', '>=', now()->startOfMonth())
            ->count();

        return max(0, $this->membership->max_bookings_per_month - $monthlyBookings);
    }

    public function assignMembership(Membership $membership, $duration = null)
    {
        $this->membership_id = $membership->id;
        
        if ($duration) {
            $this->membership_expires_at = now()->addDays($duration);
        } else {
            $this->membership_expires_at = now()->addDays($membership->duration_days);
        }
        
        $this->save();
    }

    public function removeMembership()
    {
        $this->membership_id = null;
        $this->membership_expires_at = null;
        $this->save();
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            function ($query, $search) {
                $query
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            }
        );
    }

    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }
}
