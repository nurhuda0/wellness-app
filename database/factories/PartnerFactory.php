<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = array_keys(Partner::getTypes());
        $cities = ['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Ras Al Khaimah', 'Fujairah', 'Umm Al Quwain'];
        
        return [
            'name' => $this->faker->company(),
            'type' => $this->faker->randomElement($types),
            'city' => $this->faker->randomElement($cities),
            'description' => $this->faker->paragraph(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'website' => $this->faker->url(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the partner is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the partner is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inactive',
        ]);
    }

    /**
     * Indicate that the partner is a gym.
     */
    public function gym(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Partner::TYPE_GYM,
        ]);
    }

    /**
     * Indicate that the partner is a spa.
     */
    public function spa(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Partner::TYPE_SPA,
        ]);
    }

    /**
     * Indicate that the partner is a sports club.
     */
    public function sportsClub(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Partner::TYPE_SPORTS_CLUB,
        ]);
    }

    /**
     * Indicate that the partner is a wellness center.
     */
    public function wellnessCenter(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => Partner::TYPE_WELLNESS_CENTER,
        ]);
    }
}
