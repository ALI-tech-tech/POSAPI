<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [];

        $categories = DB::table('categories')->pluck('id');
        $providers = DB::table('providers')->pluck('id');

        for ($i = 1; $i <= 50; $i++) {
            $products[] = [
                'category_id' => $categories->random(),
                'provider_id' => $providers->random(),
                'name' => 'Product ' . $i,
                'barcode' => null,
                'buy' => rand(10, 100),
                'sell' => rand(100, 200),
                'description' => 'Description of Product ' . $i,
                'quantity' => rand(1, 100),
            ];
        }

        DB::table('products')->insert($products);
    }
}
