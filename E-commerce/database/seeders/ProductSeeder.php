<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name'        => 'AppPhone X12 Pro',
                'description' => 'Smartphone flagship dengan kamera pro dan performa tertinggi.',
                'image'       => 'https://placehold.co/600x600/111111/ffffff?text=AppPhone+X12+Pro',
                'price'       => 21999000,
                'stock'       => 20,
                'product_category_id' => 1, // Assuming 'Phone' category has ID 1
            ],
            [
                'name'        => 'AppBook Pro 14',
                'description' => 'Laptop bertenaga untuk profesional dan kreator.',
                'image'       => 'https://placehold.co/600x600/111111/ffffff?text=AppBook+Pro+14',
                'price'       => 28999000,
                'stock'       => 15,
                'product_category_id' => 2, // Assuming 'Laptop' category has ID 2
            ],
            [
                'name'        => 'AppTab Pro 10',
                'description' => 'Tablet layar tajam dengan performa tinggi untuk kerja kreatif.',
                'image'       => 'https://placehold.co/600x600/111111/ffffff?text=AppTab+Pro+10',
                'price'       => 10999000,
                'stock'       => 20,
                'product_category_id' => 3, // Assuming 'Tablet' category has ID 3
            ],
        ]);
    }
}
