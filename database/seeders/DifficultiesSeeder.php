<?php

namespace Database\Seeders;

use App\Models\Difficulty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DifficultiesSeeder extends Seeder
{
    const DIFFICULTIES = [
        'Principiante',
        'Intermedio',
        'Avanzado'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            $difficulty = Difficulty::where('difficulty', '=', self::DIFFICULTIES[$i])->get();
            
            if (!$difficulty->isEmpty()) continue;
            Difficulty::create([
              'difficulty' => self::DIFFICULTIES[$i]
            ]);
        }
    }
}
