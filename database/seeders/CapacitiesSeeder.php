<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CapacitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('capacities')->insert([
           'amount_capacity' => 42,
            'type' => 'Kapasitas baterai 42.2 kWh',
        ]);
    }
}
