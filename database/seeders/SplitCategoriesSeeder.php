<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class SplitCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Set split categories');

        $categoryNameList = [
            'Auto Parts & Accessories | Car and Truck Parts',
            'Auto Parts & Accessories | Motorcycle Parts',

            'Boats | Fishing Boats',
            'Boats | Sailboats',

            'Musical Instruments | Guitars & Basses',
            'Musical Instruments | String Instruments',

            'Computers, Tablets & Network Hardware | Computer Components & Parts',
            'Computers, Tablets & Network Hardware | Laptops & Netbooks',

            'TV, Video & Home Audio Electronics | Media Streamers',
            'TV, Video & Home Audio Electronics | TV, Video & Audio Accessories',
        ];

        foreach ($categoryNameList as $name) {
            Category::factory()->state([
                'name' => $name,
                'premium_amount' => 0,
            ])->create();
        }
    }
}
