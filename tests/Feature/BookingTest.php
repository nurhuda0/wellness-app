<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Carbon\Carbon;

class BookingTest extends TestCase
{
    use DatabaseTransactions;

    public function test_booking_model_works()
    {
        $user = User::factory()->create();
        $partner = Partner::factory()->active()->create();
        $booking = Booking::factory()->create([
            'user_id' => $user->id,
            'partner_id' => $partner->id,
        ]);

        $this->assertInstanceOf(User::class, $booking->user);
        $this->assertInstanceOf(Partner::class, $booking->partner);
        $this->assertEquals($user->id, $booking->user->id);
        $this->assertEquals($partner->id, $booking->partner->id);
    }

    public function test_user_can_view_booking_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/bookings');
        $response->assertStatus(200);
    }

    public function test_user_can_view_booking_create()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/bookings/create');
        $response->assertStatus(200);
    }

    public function test_user_can_create_booking()
    {
        $user = User::factory()->create();
        $partner = Partner::factory()->active()->create();
        $bookingTime = Carbon::now()->addDays(2)->setTime(10, 0);

        $response = $this->actingAs($user)->post('/bookings', [
            'partner_id' => $partner->id,
            'booking_time' => $bookingTime->format('Y-m-d H:i:s'),
            'notes' => 'Test booking',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'partner_id' => $partner->id,
            'status' => Booking::STATUS_PENDING,
        ]);
    }
}
