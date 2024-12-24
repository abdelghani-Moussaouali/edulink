<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\keywords>
 */
class keywordsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $keywords = [
            'big data',
            'AI',
            'NLP',
            'deep learning',
            'business',
            'education',
        ];
        return [
            'keyword_name' => Arr::random($keywords),

        ];
    }
}
