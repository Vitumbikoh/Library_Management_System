<?php

// database/factories/BookFactory.php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        $categories = ['Fiction', 'Non-Fiction', 'Science', 'History', 'Biography']; // You can modify this list
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'year_of_publication' => $this->faker->year,
            'category' => $this->faker->randomElement($categories), // Pick a random category from the list
            'isbn' => $this->faker->unique()->isbn13,
            'quantity_available' => $this->faker->numberBetween(1, 50),
            'description' => $this->faker->text,
            'location' => $this->faker->city,
        ];
    }
}
