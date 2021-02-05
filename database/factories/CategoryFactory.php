<?php

namespace Database\Factories;

use App\Imports\CategoryImport;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maatwebsite\Excel\Facades\Excel;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Excel::import(new CategoryImport, storage_path('app/tablesheets/categories.xlsx'));
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->paragraph(3)
        ];
    }
}
