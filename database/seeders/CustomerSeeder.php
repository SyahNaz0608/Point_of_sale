<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 80; $i++) {
            Customer::create ([
                'name'    => $faker->name,
                'email'   => $faker->email,
                'address' => $faker->address,
                'phone'   => '0'.$faker->numberBetween(81200000000, 82112345678),
            ]);
        } 
    }
}
