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
            'password' => Hash::make('Password')
        ]);
        User::create([
            'name' => 'Claudio Zhunaula',
            'email' => 'claudio_zhunaula@hotmail.es',
            'password' => Hash::make('Claudio2*')
        ]);
        User::create([
            'name' => 'Cesar Gualán',
            'email' => 'cjgualan@gmail.com',
            'password' => Hash::make('Cesarin6*')
        ]);
        User::create([
            'name' => 'Atic Gualán',
            'email' => 'sumakatic@gmail.com',
            'password' => Hash::make('Atic6*')
        ]);
        User::create([
            'name' => 'Bertha Gualán',
            'email' => 'blgualan@gmail.com',
            'password' => Hash::make('Bertha4*')
        ]);
    }
}
