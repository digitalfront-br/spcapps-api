<?php

namespace Database\Factories;

use App\Imports\QuestionImport;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Maatwebsite\Excel\Facades\Excel;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Excel::import(new QuestionImport, storage_path('app/tablesheets/questions.xlsx'));
        return [];
    }
}
