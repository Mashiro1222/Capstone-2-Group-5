<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FruitsAndVegetablesSeeder extends Seeder
{
    public function run()
    {
        // Fruits data
        $fruits = [
            ['name' => 'Apple'],
            ['name' => 'Grapes'],
            ['name' => 'Mango'],
            ['name' => 'Orange'],
            ['name' => 'Tomato'],
            ['name' => 'Watermelon'],
            ['name' => 'Banana'],
            ['name' => 'Kiwi'],
            ['name' => 'Strawberry'],
            ['name' => 'Peach'],
            ['name' => 'Pineapple'],
            ['name' => 'Papaya'],
            ['name' => 'Avocado'],
            ['name' => 'Cherry'],
            ['name' => 'Plum'],
            ['name' => 'Lemon'],
            ['name' => 'Durian'],
            ['name' => 'Pomelo'],
            ['name' => 'Bilimbi'],
            ['name' => 'Calamansi'],
        ];

        // Vegetables data
        $vegetables = [
            ['name' => 'Bitter Melon'],
            ['name' => 'Cabbage'],
            ['name' => 'Carrots'],
            ['name' => 'Celery'],
            ['name' => 'Onion'],
            ['name' => 'Potato'],
            ['name' => 'Bottle Gourd'],
            ['name' => 'String Beans'],
            ['name' => 'Peanuts'],
            ['name' => 'Lima Beans'],
            ['name' => 'Mustard Greens'],
            ['name' => 'Eggplant'],
            ['name' => 'Squash'],
            ['name' => 'Garlic'],
            ['name' => 'Hyacinth Beans'],
            ['name' => 'Ribbed Gourd'],
            ['name' => 'Cucumber'],
            ['name' => 'Ladies’ Fingers'],
            ['name' => 'Winged Beans'],
        ];

        // Insert fruits into the fruits table
        DB::table('fruits')->insert($fruits);

        // Insert vegetables into the vegetables table
        DB::table('vegetables')->insert($vegetables);
    }
}
