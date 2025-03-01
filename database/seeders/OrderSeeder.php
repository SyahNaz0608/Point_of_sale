<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            Order::create ([
                'invoice'     => $faker->unique()->randomNumber(8),
                'customer_id' => $faker->numberBetween(1, 80),
                'user_id'     => $faker->numberBetween(1, 3),
                'total'       => $faker->randomNumber(8),
            ]);

        }
    }
}
