<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'hr_email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $company = Company::create([
            'name' => $request->company_name,
            'hr_email' => $request->hr_email,
            'status' => 'active',
        ]);

        $user = User::create([
            'name' => $request->company_name . ' HR',
            'email' => $request->hr_email,
            'password' => Hash::make($request->password),
            'role' => User::ROLE_HR_ADMIN,
            'company_id' => $company->id,
        ]);

        // Optionally, log in the user or redirect with a message
        return redirect()->route('login')->with('success', 'Company and HR account registered successfully. Please log in.');
    }
}
