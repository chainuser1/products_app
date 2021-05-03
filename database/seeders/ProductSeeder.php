<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Str;
use DB;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [];

        foreach(range(1,20) as $index){
            $products[] = [
                'name' => Str::random(10).$index,
                'price' => 100.00 + $index,
                'category_id' => 219 + $index,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('products')->insert($products);

    }
}
