<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => '12345678',
            'email' => 'Juan',
            'password' => 'Pérez',
            'tipo' => 'Admin',
            'password' => bcrypt('123456789'),
        ]);
    }
}
