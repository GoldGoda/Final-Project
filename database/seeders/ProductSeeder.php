<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_one = new Product([
            "img"         => "/storage/images/pcg.png",
            "name"        => "PC Gamer",
            "description" => "Pc gamer with last features like a ultimate cpu",
            "price"       => "2000",
            "stock"       => 5,
            "category_id" => 1,
        ]);
        $product_one->save();

        $product_two = new Product([
            "img"         => "/storage/images/pcg.png",
            "name"        => "PC Gamer",
            "description" => "Pc gamer with last features like a ultimate cpu",
            "price"       => "2000",
            "stock"       => 5,
            "category_id" => 1,
        ]);
        $product_two->save();

        $product_three = new Product([
            "img"         => "/storage/images/pcg.png",
            "name"        => "PC Gamer",
            "description" => "Pc gamer with last features like a ultimate cpu",
            "price"       => "2000",
            "stock"       => 5,
            "category_id" => 1,
        ]);
        $product_three->save();

        $product_four = new Product([
            "img"         => "/storage/images/pcg.png",
            "name"        => "PC Gamer",
            "description" => "Pc gamer with last features like a ultimate cpu",
            "price"       => "2000",
            "stock"       => 5,
            "category_id" => 1,
        ]);
        $product_four->save();

        $product_five = new Product([
            "img"         => "/storage/images/pcg.png",
            "name"        => "PC Gamer",
            "description" => "Pc gamer with last features like a ultimate cpu",
            "price"       => "2000",
            "stock"       => 5,
            "category_id" => 1,
        ]);
        $product_five->save();

    }
}
