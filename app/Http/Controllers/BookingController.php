<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = $user->bookings()->with(['partner']);

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->byStatus($request->status);
        }

        // Filter by partner
        if ($request->has('partner_id') && $request->partner_id !== '') {
            $query->byPartner($request->partner_id);
        }

        // Filter by date range
        if ($request->has('date_from')) {
            $query->where('booking_time', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->where('booking_time', '<=', $request->date_to);
        }

        $bookings = $query->orderBy('booking_time', 'desc')->paginate(10);

        // Get partners for filter dropdown
        $partners = Partner::where('status', 'active')->get();

        return view('bookings.index', compact('bookings', 'partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $partnerId = $request->partner_id;
        $partner = null;
        
        if ($partnerId) {
            $partner = Partner::findOrFail($partnerId);
        }

        $partners = Partner::where('status', 'active')->get();
        
        return view('bookings.create', compact('partners', 'partner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'booking_time' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        // Check if the time slot is available
        $bookingTime = Carbon::parse($request->booking_time);
        $existingBooking = Booking::where('partner_id', $request->partner_id)
            ->where('booking_time', $bookingTime)
            ->where('status', '!=', Booking::STATUS_CANCELLED)
            ->first();

        if ($existingBooking) {
            return back()->withErrors(['booking_time' => 'This time slot is already booked.']);
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'partner_id' => $request->partner_id,
            'booking_time' => $bookingTime,
            'status' => Booking::STATUS_PENDING,
            'notes' => $request->notes,
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        // Ensure user can only view their own bookings (unless admin)
        if ($booking->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $booking->load(['partner', 'user']);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        // Ensure user can only edit their own bookings (unless admin)
        if ($booking->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        // Only allow editing if booking is pending or confirmed and not too close
        if (!$booking->canBeCancelled()) {
            return redirect()->route('bookings.show', $booking)
                ->with('error', 'This booking cannot be modified.');
        }

        $partners = Partner::where('status', 'active')->get();

        return view('bookings.edit', compact('booking', 'partners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // Ensure user can only update their own bookings (unless admin)
        if ($booking->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'booking_time' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        // Check if the new time slot is available
        $bookingTime = Carbon::parse($request->booking_time);
        $existingBooking = Booking::where('partner_id', $booking->partner_id)
            ->where('booking_time', $bookingTime)
            ->where('id', '!=', $booking->id)
            ->where('status', '!=', Booking::STATUS_CANCELLED)
            ->first();

        if ($existingBooking) {
            return back()->withErrors(['booking_time' => 'This time slot is already booked.']);
        }

        $booking->update([
            'booking_time' => $bookingTime,
            'notes' => $request->notes,
        ]);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        // Ensure user can only cancel their own bookings (unless admin)
        if ($booking->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        if (!$booking->canBeCancelled()) {
            return redirect()->route('bookings.show', $booking)
                ->with('error', 'This booking cannot be cancelled.');
        }

        $booking->update(['status' => Booking::STATUS_CANCELLED]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking cancelled successfully!');
    }

    /**
     * Get available time slots for a partner
     */
    public function getAvailableSlots(Request $request)
    {
        $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'date' => 'required|date|after:today',
        ]);

        $partner = Partner::findOrFail($request->partner_id);
        $date = Carbon::parse($request->date);
        
        // Generate time slots (9 AM to 6 PM, every hour)
        $timeSlots = [];
        $startTime = $date->copy()->setTime(9, 0);
        $endTime = $date->copy()->setTime(18, 0);

        for ($time = $startTime; $time <= $endTime; $time->addHour()) {
            // Check if this slot is available
            $existingBooking = Booking::where('partner_id', $partner->id)
                ->where('booking_time', $time)
                ->where('status', '!=', Booking::STATUS_CANCELLED)
                ->first();

            $timeSlots[] = [
                'time' => $time->format('H:i'),
                'datetime' => $time->format('Y-m-d H:i:s'),
                'available' => !$existingBooking,
            ];
        }

        return response()->json($timeSlots);
    }

    /**
     * Calendar view for bookings
     */
    public function calendar(Request $request)
    {
        $user = Auth::user();
        $month = $request->get('month', now()->format('Y-m'));
        
        $startOfMonth = Carbon::parse($month)->startOfMonth();
        $endOfMonth = Carbon::parse($month)->endOfMonth();

        $bookings = $user->bookings()
            ->whereBetween('booking_time', [$startOfMonth, $endOfMonth])
            ->with(['partner'])
            ->get()
            ->groupBy(function ($booking) {
                return $booking->booking_time->format('Y-m-d');
            });

        return view('bookings.calendar', compact('bookings', 'month'));
    }

    /**
     * API endpoint for getting user's bookings
     */
    public function apiIndex(Request $request)
    {
        $user = Auth::user();
        $query = $user->bookings()->with(['partner']);

        if ($request->has('status')) {
            $query->byStatus($request->status);
        }

        $bookings = $query->orderBy('booking_time', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $bookings,
        ]);
    }

    /**
     * API endpoint for creating a booking
     */
    public function apiStore(Request $request)
    {
        $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'booking_time' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
        ]);

        // Check availability
        $bookingTime = Carbon::parse($request->booking_time);
        $existingBooking = Booking::where('partner_id', $request->partner_id)
            ->where('booking_time', $bookingTime)
            ->where('status', '!=', Booking::STATUS_CANCELLED)
            ->first();

        if ($existingBooking) {
            return response()->json([
                'success' => false,
                'message' => 'This time slot is already booked.',
            ], 422);
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'partner_id' => $request->partner_id,
            'booking_time' => $bookingTime,
            'status' => Booking::STATUS_PENDING,
            'notes' => $request->notes,
        ]);

        $booking->load(['partner']);

        return response()->json([
            'success' => true,
            'data' => $booking,
            'message' => 'Booking created successfully!',
        ]);
    }
}
