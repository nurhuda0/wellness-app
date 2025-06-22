<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bookingTime = Carbon::now()->addDays(rand(1, 30))->setTime(rand(9, 18), 0);
        
        return [
            'user_id' => User::factory(),
            'partner_id' => Partner::factory(),
            'booking_time' => $bookingTime,
            'status' => $this->faker->randomElement([
                Booking::STATUS_PENDING,
                Booking::STATUS_CONFIRMED,
                Booking::STATUS_CANCELLED,
                Booking::STATUS_COMPLETED,
            ]),
            'notes' => $this->faker->optional(0.7)->sentence(),
        ];
    }

    /**
     * Indicate that the booking is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Booking::STATUS_PENDING,
        ]);
    }

    /**
     * Indicate that the booking is confirmed.
     */
    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Booking::STATUS_CONFIRMED,
        ]);
    }

    /**
     * Indicate that the booking is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Booking::STATUS_CANCELLED,
        ]);
    }

    /**
     * Indicate that the booking is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => Booking::STATUS_COMPLETED,
        ]);
    }

    /**
     * Indicate that the booking is in the past.
     */
    public function past(): static
    {
        return $this->state(fn (array $attributes) => [
            'booking_time' => Carbon::now()->subDays(rand(1, 30))->setTime(rand(9, 18), 0),
        ]);
    }

    /**
     * Indicate that the booking is in the future.
     */
    public function future(): static
    {
        return $this->state(fn (array $attributes) => [
            'booking_time' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(9, 18), 0),
        ]);
    }
}
