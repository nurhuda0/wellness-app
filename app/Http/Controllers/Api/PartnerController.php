<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query();
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        if ($request->filled('type')) {
            $query->where('category', $request->type);
        }
        $partners = $query->get();
        // If no real data, return mock
        if ($partners->isEmpty()) {
            $partners = [
                [ 'id' => 1, 'name' => 'Mock Gym', 'city' => 'Mock City', 'category' => 'gym' ],
                [ 'id' => 2, 'name' => 'Mock Spa', 'city' => 'Mock City', 'category' => 'spa' ],
            ];
        }
        return response()->json($partners);
    }
} 