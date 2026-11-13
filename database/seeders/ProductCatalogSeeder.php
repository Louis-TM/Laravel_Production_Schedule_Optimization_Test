<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductType;
use App\Models\Product;


class ProductCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductType::create([
            'type_name' => 'Type 1',
            'production_speed' => 715,
        ]);
        ProductType::create([
            'type_name' => 'Type 2',
            'production_speed' => 770,
        ]);
        ProductType::create([
            'type_name' => 'Type 3',
            'production_speed' => 1000,
        ]);

        Product::create([
            'product_name' => 'Product A',
            'product_type_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Product B',
            'product_type_id' => 1,
        ]);

        Product::create([
            'product_name' => 'Product C',
            'product_type_id' => 2,
        ]);

        Product::create([
            'product_name' => 'Product D',
            'product_type_id' => 3,
        ]);

        Product::create([
            'product_name' => 'Product E',
            'product_type_id' => 3,
        ]);

        Product::create([
            'product_name' => 'Product F',
            'product_type_id' => 1,
        ]);
    }
}
