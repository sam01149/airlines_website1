<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;

class Usertabelseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true, // Tambahkan ini
        ]);
    }
}
