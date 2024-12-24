<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class specializationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specializations = [
            'Artificial Intelligence',
            'Machine Learning',
            'Cloud computing',
            'Blockchain',
            'Cybersecurity',
            'Web development',
            'Mobile app development',
            'Mechanical engineering',
            'Robotics',
            'Natural Language Processing',
        ];


        return [
            'specialization_name' => Arr::random($specializations),

        ];
    }
}
