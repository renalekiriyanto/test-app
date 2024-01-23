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
        $list_categories = [
            [
                'name' => 'Minuman'
            ],
            [
                'name' => 'Makanan'
            ],
            [
                'name' => 'Pakaian'
            ],
            [
                'name' => 'Gadget'
            ]
        ];

        foreach($list_categories as $item){
            $data = \App\Models\Category::create($item);
        }

    }
}
