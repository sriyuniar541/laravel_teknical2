<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->truncate();

        DB::table('kategori')->insert([
            [
                'nama' => 'Salary',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Other Income',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Family Expense',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Transport Expense',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Meal Expense',
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ]);
    }
}
