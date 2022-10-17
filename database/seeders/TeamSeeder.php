<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::first();

        $group_a = $category->groups()->create([
            'description' => 'Grupo A'
        ]);

        $group_a->teams()->first()->factory(6)->make();

        $group_b = $category->groups()->create([
            'description' => 'Grupo B'
        ]);

        $group_b->teams()->factory(5)->make();

        $group_c = $category->groups()->create([
            'description' => 'Grupo C'
        ]);

        $group_c->teams()->factory(4)->make();
    }
}
