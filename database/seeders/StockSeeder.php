<?php

namespace Database\Seeders;

use App\Models\Stok_supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stok_suppliers')->insert([[
            'name' => 'Pomade',
            'price' => '100000',
            'Information' => 'Klimis',
            'product_img' => '',
            'quantity' => '10',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
                'name' => 'Semir',
                'price' => '200000',
                'Information' => 'Warna',
                'product_img' => '',
                'quantity' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'TV',
                'price' => '300000',
                'Information' => 'Nyala',
                'product_img' => '',
                'quantity' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Radio',
                'price' => '400000',
                'Information' => 'Bunyi',
                'product_img' => '',
                'quantity' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Meja',
                'price' => '500000',
                'Information' => 'Kayu',
                'product_img' => '',
                'quantity' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rumah',
                'price' => '500000',
                'Information' => 'Cat',
                'product_img' => '',
                'quantity' => '10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ],
    );
    }
}
