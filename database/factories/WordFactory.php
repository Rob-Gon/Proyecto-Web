<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Word;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Word>
 */
class WordFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Word::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'word' => 'Word '.$this->faker->word,
            'example' => $this->faker->paragraph,
            'category_id' => $this->faker->numberBetween(1, 10),
            'language_id' => $this->faker->numberBetween(1, 10),
            'user_id' => 1
        ];
    }
}
