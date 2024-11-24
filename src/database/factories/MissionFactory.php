<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mission>
 */
class MissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ar_SA');

        return [
            'permit_holder' => $faker->name,
            'license_number' => $faker->numerify('#####'),
            'cin' => $faker->numerify('########'),
            'car_number' => $faker->bothify('??-####'),
            'rank_or_position' => $faker->jobTitle,
            'internal_function' => $faker->word,
            'vehicle_usage_reason' => 'استخدام السيارة لغرض ' . $faker->word,
            'departure_location' => $faker->city,
            'destination_location' => $faker->city,
            'companions' => $faker->name . '، ' . $faker->name,
            'start_date' => $faker->date(),
            'start_time' => $faker->time(),
            'return_date' => $faker                         ->date(),
            'return_time' => $faker->time(),
            'expenses' => $faker->randomFloat(2, 10, 1000),
            'user_id' => 1, // Associer à un utilisateur existant ou généré
        ];
    }
}
