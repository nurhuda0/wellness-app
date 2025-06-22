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
                'description' => 'Modern gym with state-of-the-art equipment and professional trainers. We offer personal training, group classes, and nutrition consultation.',
                'address' => 'Sheikh Zayed Road, Dubai',
                'phone' => '+971 4 123 4567',
                'email' => 'info@fitnessfirst.ae',
                'website' => 'https://fitnessfirst.ae',
                'status' => 'active',
            ],
            [
                'name' => 'Spa Serenity',
                'type' => 'spa',
                'city' => 'Abu Dhabi',
                'description' => 'Luxury spa offering massage therapy, facial treatments, and wellness packages in a tranquil environment.',
                'address' => 'Corniche Road, Abu Dhabi',
                'phone' => '+971 2 987 6543',
                'email' => 'bookings@spaserenity.ae',
                'website' => 'https://spaserenity.ae',
                'status' => 'active',
            ],
            [
                'name' => 'Yoga Harmony Center',
                'type' => 'wellness_center',
                'city' => 'Sharjah',
                'description' => 'Holistic wellness center specializing in yoga, meditation, and mindfulness practices for all skill levels.',
                'address' => 'Al Majaz Waterfront, Sharjah',
                'phone' => '+971 6 555 1234',
                'email' => 'hello@yogaharmony.ae',
                'website' => 'https://yogaharmony.ae',
                'status' => 'active',
            ],
            [
                'name' => 'Elite Sports Club',
                'type' => 'sports_club',
                'city' => 'Dubai',
                'description' => 'Premium sports club with tennis courts, swimming pool, and fitness facilities. Perfect for families and professionals.',
                'address' => 'Jumeirah Beach Road, Dubai',
                'phone' => '+971 4 456 7890',
                'email' => 'membership@elitesports.ae',
                'website' => 'https://elitesports.ae',
                'status' => 'active',
            ],
            [
                'name' => 'Wellness Oasis',
                'type' => 'wellness_center',
                'city' => 'Abu Dhabi',
                'description' => 'Comprehensive wellness center offering physiotherapy, chiropractic care, and alternative medicine treatments.',
                'address' => 'Al Reem Island, Abu Dhabi',
                'phone' => '+971 2 111 2222',
                'email' => 'care@wellnessoasis.ae',
                'website' => 'https://wellnessoasis.ae',
                'status' => 'active',
            ],
            [
                'name' => 'Power Gym',
                'type' => 'gym',
                'city' => 'Sharjah',
                'description' => '24/7 gym facility with heavy lifting equipment, cardio machines, and specialized training programs.',
                'address' => 'Al Khan Street, Sharjah',
                'phone' => '+971 6 333 4444',
                'email' => 'info@powergym.ae',
                'website' => 'https://powergym.ae',
                'status' => 'active',
            ],
            [
                'name' => 'Tranquil Spa',
                'type' => 'spa',
                'city' => 'Dubai',
                'description' => 'Boutique spa offering traditional and modern treatments in a peaceful setting with expert therapists.',
                'address' => 'Palm Jumeirah, Dubai',
                'phone' => '+971 4 777 8888',
                'email' => 'relax@tranquilspa.ae',
                'website' => 'https://tranquilspa.ae',
                'status' => 'active',
            ],
            [
                'name' => 'Marina Sports Complex',
                'type' => 'sports_club',
                'city' => 'Abu Dhabi',
                'description' => 'Multi-sport complex with indoor and outdoor facilities including football, basketball, and swimming.',
                'address' => 'Marina Mall Area, Abu Dhabi',
                'phone' => '+971 2 555 6666',
                'email' => 'sports@marinacomplex.ae',
                'website' => 'https://marinacomplex.ae',
                'status' => 'active',
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
