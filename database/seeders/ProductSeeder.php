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
               'name' => 'PeperoniPizza',
               'size' => '28',
               'name_price' => '100',
               'type' => 'Coke',
               'type_price' => '50'

           ],
           [
           'name' => 'CarbonaraPizza',
            'size' => '30',
            'name_price' => '120',
            'type' => 'Pepsi',
            'type_price' => '20'

        ],

            [
                'name' => 'CheesPizza',
                'size' => '26',
                'name_price' => '90',
                'type' => 'AppleJuice',
                'type_price' => '50'

            ],
            [
                'name' => 'BananaPizza',
                'size' => '28',
                'name_price' => '112',
                'type' => 'Sprite',
                'type_price' => '60'

            ]



        ]);
    }
}
