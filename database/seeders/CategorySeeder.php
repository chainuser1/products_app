<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Str;
use DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        foreach(range(1,100) as $index){
            $categories[] = [
                "name" => Str::random(10),
                "updated_at" => now(),
                "created_at" => now(),
            ];
        }

        DB::table("categories")->insert($categories);
    }
}
