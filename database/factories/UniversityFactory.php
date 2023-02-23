<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $dictUniversities = [
            'Nazarbayev University',
            'Kazakh-British Technical University',
            'Al-Farabi Kazakh National University',
            'Karaganda State Technical University',
            'Eurasian National University',
            'Suleyman Demirel University',
            'Kazakh-German University',
            'KIMEP University',
            'International IT University',
            'Almaty Management University'
        ];
        return [
            'title' => $this->faker->unique()->randomElement($dictUniversities)
        ];
    }
}
