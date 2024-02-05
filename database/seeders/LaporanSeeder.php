<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('laporan')->truncate();

        DB::table('laporan')->insert([
            [
                'kategori_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kategori_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ]);
    }
    
}
