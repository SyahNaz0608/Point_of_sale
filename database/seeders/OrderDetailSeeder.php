<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $orders = Order::all();

        foreach ($orders as $order) {
            for ($i = 0; $i < 2; $i++) {
                OrderDetail::create ([
                    'order_id'   => $order->id,
                    'product_id' => $faker->numberBetween(1, 40),
                    'qty'        => $faker->numberBetween(1, 100),
                    'price'      => $faker->randomFloat(1, 1000, 100000),
                ]);
            }
        }
    }
}
