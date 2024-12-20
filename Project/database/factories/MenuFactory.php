<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    // Tentukan model yang digunakan oleh factory ini
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_menu' => $this->faker->words(2, true),
            'category_id' => Category::factory(), 
            'harga' => $this->faker->randomFloat(2, 10000, 50000), 
            'deskripsi' => $this->faker->sentence(),   
        ];
    }
}
