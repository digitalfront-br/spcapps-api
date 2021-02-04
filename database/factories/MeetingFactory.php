<?php

namespace Database\Factories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class MeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $qtd = random_int(5, 20);
        for ($item = 0; $item < $qtd; $item++) {
            DB::table('meeting_question')->insert([
                'meeting_id' => $this->faker->numberBetween(1, 4),
                'question_id' => $this->faker->numberBetween(1, 200),
            ]);
        }
        return [
            'title' => $this->faker->firstNameMale
        ];
    }
}
