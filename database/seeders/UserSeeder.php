<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Pedro Guaillas',
            'email' => 'peter.tufi@gmail.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Cesar Gualán',
            'email' => 'cesitar@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
