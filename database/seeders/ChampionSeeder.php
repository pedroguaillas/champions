<?php

namespace Database\Seeders;

use App\Models\Champion;
use Illuminate\Database\Seeder;

class ChampionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $champion = Champion::create([
            'name' => 'WIKIS 2022',
            'start_date' => '2022-10-01',
            'end_date' => '2022-12-05',
            'organizer' => 'ULTRA SPORT'
        ]);

        $champion->categories()->createMany([
            [
                'name' => 'Hombres',
                'inscription' => 35,
                'gender' => 'masculino'
            ],
            [
                'name' => 'Mujeres',
                'inscription' => 30,
                'gender' => 'femenino'
            ],
            [
                'name' => 'Sub 17 Hombres',
                'inscription' => 15,
                'gender' => 'masculino'
            ],
            [
                'name' => 'Sub 12 Hombres',
                'inscription' => 15,
                'gender' => 'masculino'
            ],
            [
                'name' => 'Post 40 Hombres',
                'inscription' => 33,
                'gender' => 'masculino'
            ]
        ]);
    }
}
