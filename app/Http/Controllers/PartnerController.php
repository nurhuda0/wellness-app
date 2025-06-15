<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::with('courses')->get();
        return view('partners.index', compact('partners'));
    }

    public function show(Partner $partner)
    {
        return view('partners.show', compact('partner'));
    }
}
