<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'photo' => $this->faker->imageUrl(),
            'genre' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'quantity_available' => $this->faker->numberBetween(1, 100),
        ];
    }
}
