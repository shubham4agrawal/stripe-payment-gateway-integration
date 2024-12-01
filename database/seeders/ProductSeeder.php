<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Database\Factories\Product as ProdductFactory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $productCount = 100;

        for($i=1; $i <= $productCount; $i++) {
            Product::create(['name' => "Product {$i}", 'price' => (rand(1,200) * 5 . '.99'), 'description' => "Description of Product {$i}"]);
        }
        
    }
}
