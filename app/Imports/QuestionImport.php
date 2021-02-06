<?php

namespace App\Imports;

use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use NunoMaduro\Collision\ConsoleColor;
use SebastianBergmann\Environment\Console;

class QuestionImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Question([
            'title' => $row['title'],
            'category_id' => $row['category_id']
        ]);
    }
}
