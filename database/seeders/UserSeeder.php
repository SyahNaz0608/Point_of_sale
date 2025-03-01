<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Syah', 'email'          => 'syah@example.test', 'password'          => bcrypt('Syah')],
            ['name' => 'Syahine', 'email'       => 'syahine@example.test', 'password'       => bcrypt('Syah')],
            ['name' => 'Syahgilbartar', 'email' => 'syahgilbartar@example.test', 'password' => bcrypt('Syah')],
        ];
        \App\Models\User::insert($data);
    }
}
