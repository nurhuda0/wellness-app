<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the partners with filtering.
     */
    public function index(Request $request)
    {
        $query = Partner::where('status', 'active');

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Cache the results for 5 minutes to improve performance
        $cacheKey = 'partners_' . md5($request->fullUrl());
        $partners = \Illuminate\Support\Facades\Cache::remember($cacheKey, 300, function () use ($query) {
            return $query->orderBy('name')->paginate(12);
        });

        // Cache the filter options
        $types = \Illuminate\Support\Facades\Cache::remember('partner_types', 3600, function () {
            return Partner::getTypes();
        });
        
        $cities = \Illuminate\Support\Facades\Cache::remember('partner_cities', 3600, function () {
            return Partner::distinct()->pluck('city')->sort();
        });

        return view('partners.index', compact('partners', 'types', 'cities'));
    }

    /**
     * Display the specified partner.
     */
    public function show(Partner $partner)
    {
        return view('partners.show', compact('partner'));
    }

    /**
     * API endpoint for getting partners (for future API integration)
     */
    public function apiIndex(Request $request)
    {
        $query = Partner::where('status', 'active');

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $partners = $query->orderBy('name')->get();

        return response()->json([
            'success' => true,
            'data' => $partners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
