<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name' => 'Acme Corp',
            'hr_email' => 'hr@acme.com',
            'status' => 'active',
        ]);
        Company::create([
            'name' => 'Globex Inc',
            'hr_email' => 'hr@globex.com',
            'status' => 'active',
        ]);
    }
}
