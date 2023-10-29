<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Data extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' => 'Rico',
            'password' => Hash::make('123'),
            'email' => 'rico@gmail.com',
            'number' => '123',
            'role'=>'admin',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'syahrul',
            'password' => Hash::make('123'),
            'email' => 'syahrul@gmail.com',
            'number' => '123',
            'role'=>'customer',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ],
    );
    }
}
