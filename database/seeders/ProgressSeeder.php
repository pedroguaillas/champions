<?php

namespace Database\Seeders;

use App\Models\Champion;
use Illuminate\Database\Seeder;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $champion = Champion::first();

        $champion->progress()->createMany([
            ['description' => 'Fase de grupos', 'date' => '2022-10-01'],
            ['description' => 'Octavos de final', 'date' => '2022-10-22'],
            ['description' => 'Cuartos de final', 'date' => '2022-10-29'],
            ['description' => 'Semi final', 'date' => '2022-11-05'],
            ['description' => 'Final', 'date' => '2022-11-12']
        ]);
    }
}
