<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coa')->truncate();

        DB::table('coa')->insert([
            [
                'kode' => 401,
                'nama' => 'Gaji Karyawan',
                'kategori_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 402,
                'nama' => 'Gaji Ketua MPR',
                'kategori_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 403,
                'nama' => 'Profit Treding',
                'kategori_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 601,
                'nama' => 'Biaya Sekolah',
                'kategori_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 602,
                'nama' => 'Bensin',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 603,
                'nama' => 'Parkir',
                'kategori_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 604,
                'nama' => 'Makan Siang',
                'kategori_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode' => 605,
                'nama' => 'Makan Pokok Bulanan',
                'kategori_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]
           
        ]);
    }
}
