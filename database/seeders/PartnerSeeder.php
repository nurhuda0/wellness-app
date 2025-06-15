<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        $partners = [
            [
                'name' => 'Fitness First Gym',
                'type' => 'gym',
                'city' => 'Dubai',
                'description' => 'Modern gym with state-of-the-art equipment',
            ],
            [
                'name' => 'Spa Serenity',
                'type' => 'spa',
                'city' => 'Abu Dhabi',
                'description' => 'Luxury spa with wellness treatments',
            ],
            [
                'name' => 'Yoga Harmony',
                'type' => 'wellness_center',
                'city' => 'Sharjah',
                'description' => 'Yoga and wellness center',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
