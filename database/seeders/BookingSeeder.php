<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Partner;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $partners = Partner::all();

        if ($users->isEmpty() || $partners->isEmpty()) {
            $this->command->info('No users or partners found. Please run UserSeeder and PartnerSeeder first.');
            return;
        }

        // Create sample bookings
        $bookings = [
            // Past bookings (completed)
            [
                'user_id' => $users->first()->id,
                'partner_id' => $partners->first()->id,
                'booking_time' => Carbon::now()->subDays(5)->setTime(10, 0),
                'status' => Booking::STATUS_COMPLETED,
                'notes' => 'Great session! Will book again.',
            ],
            [
                'user_id' => $users->first()->id,
                'partner_id' => $partners->skip(1)->first()->id,
                'booking_time' => Carbon::now()->subDays(3)->setTime(14, 0),
                'status' => Booking::STATUS_COMPLETED,
                'notes' => 'Excellent workout session.',
            ],

            // Upcoming bookings (confirmed)
            [
                'user_id' => $users->first()->id,
                'partner_id' => $partners->first()->id,
                'booking_time' => Carbon::now()->addDays(2)->setTime(9, 0),
                'status' => Booking::STATUS_CONFIRMED,
                'notes' => 'Looking forward to this session!',
            ],
            [
                'user_id' => $users->first()->id,
                'partner_id' => $partners->skip(2)->first()->id,
                'booking_time' => Carbon::now()->addDays(5)->setTime(16, 0),
                'status' => Booking::STATUS_CONFIRMED,
                'notes' => 'First time trying this partner.',
            ],

            // Pending bookings
            [
                'user_id' => $users->first()->id,
                'partner_id' => $partners->skip(1)->first()->id,
                'booking_time' => Carbon::now()->addDays(7)->setTime(11, 0),
                'status' => Booking::STATUS_PENDING,
                'notes' => 'Hoping to get confirmed soon.',
            ],

            // Cancelled bookings
            [
                'user_id' => $users->first()->id,
                'partner_id' => $partners->first()->id,
                'booking_time' => Carbon::now()->addDays(1)->setTime(15, 0),
                'status' => Booking::STATUS_CANCELLED,
                'notes' => 'Had to cancel due to emergency.',
            ],

            // More bookings for different users (if available)
        ];

        // Add more bookings if we have multiple users
        if ($users->count() > 1) {
            $bookings[] = [
                'user_id' => $users->skip(1)->first()->id,
                'partner_id' => $partners->first()->id,
                'booking_time' => Carbon::now()->addDays(3)->setTime(13, 0),
                'status' => Booking::STATUS_PENDING,
                'notes' => 'New user booking.',
            ];
        }

        foreach ($bookings as $bookingData) {
            Booking::create($bookingData);
        }

        $this->command->info('Sample bookings created successfully!');
    }
}
