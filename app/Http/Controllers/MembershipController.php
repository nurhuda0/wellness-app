<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = Membership::active()->ordered()->get();
        
        return view('memberships.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $billingCycles = Membership::getBillingCycles();
        $defaultFeatures = Membership::getDefaultFeatures();
        
        return view('memberships.create', compact('billingCycles', 'defaultFeatures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,quarterly,yearly',
            'duration_days' => 'required|integer|min:1',
            'max_bookings_per_month' => 'required|integer|min:1',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $membership = Membership::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'billing_cycle' => $request->billing_cycle,
            'duration_days' => $request->duration_days,
            'features' => $request->features,
            'max_bookings_per_month' => $request->max_bookings_per_month,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('memberships.index')
            ->with('success', 'Membership plan created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Membership $membership)
    {
        $membership->load('users');
        
        return view('memberships.show', compact('membership'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membership $membership)
    {
        $billingCycles = Membership::getBillingCycles();
        $defaultFeatures = Membership::getDefaultFeatures();
        
        return view('memberships.edit', compact('membership', 'billingCycles', 'defaultFeatures'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membership $membership)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'billing_cycle' => 'required|in:monthly,quarterly,yearly',
            'duration_days' => 'required|integer|min:1',
            'max_bookings_per_month' => 'required|integer|min:1',
            'features' => 'nullable|array',
            'features.*' => 'string',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $membership->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'billing_cycle' => $request->billing_cycle,
            'duration_days' => $request->duration_days,
            'features' => $request->features,
            'max_bookings_per_month' => $request->max_bookings_per_month,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
            'sort_order' => $request->sort_order ?? $membership->sort_order,
        ]);

        return redirect()->route('memberships.index')
            ->with('success', 'Membership plan updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membership $membership)
    {
        // Check if membership has active users
        $activeUsers = $membership->users()->where('membership_expires_at', '>', now())->count();
        
        if ($activeUsers > 0) {
            return back()->with('error', 'Cannot delete membership plan with active users.');
        }

        $membership->delete();

        return redirect()->route('memberships.index')
            ->with('success', 'Membership plan deleted successfully!');
    }

    /**
     * Assign membership to a user
     */
    public function assignToUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'membership_id' => 'required|exists:memberships,id',
            'duration_days' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = User::findOrFail($request->user_id);
        $membership = Membership::findOrFail($request->membership_id);

        $user->assignMembership($membership, $request->duration_days);

        return back()->with('success', "Membership assigned to {$user->name} successfully!");
    }

    /**
     * Remove membership from a user
     */
    public function removeFromUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = User::findOrFail($request->user_id);
        $user->removeMembership();

        return back()->with('success', "Membership removed from {$user->name} successfully!");
    }

    /**
     * Admin dashboard for membership management
     */
    public function adminIndex()
    {
        $memberships = Membership::withCount('users')->ordered()->get();
        $totalUsers = User::count();
        $activeMemberships = User::where('membership_expires_at', '>', now())->count();
        
        return view('admin.memberships', compact('memberships', 'totalUsers', 'activeMemberships'));
    }
}
