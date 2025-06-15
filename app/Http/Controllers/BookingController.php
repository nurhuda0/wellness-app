<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Partner;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('partner')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $partners = Partner::all();
        return view('bookings.create', compact('partners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'booking_time' => 'required|date',
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'partner_id' => $validated['partner_id'],
            'booking_time' => $validated['booking_time'],
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully');
    }
}
