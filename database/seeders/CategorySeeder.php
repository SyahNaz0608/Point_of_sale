<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Makanan', 'description' => 'Kategori Makanan'],
            ['name' => 'Minuman', 'description' => 'Kategori Minuman'],
            ['name' => 'Pakaian', 'description' => 'Kategori Pakaian'],
            ['name' => 'Elektronik', 'description' => 'Kategori Elektronik'],
            ['name' => 'Pulpen', 'description' => 'Kategori Sekolah']
        ];
        \App\Models\Category::insert($data);
    }
}
