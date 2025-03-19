<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Str;

class AnggotaKelompokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('mahasiswa_kelompok')->insert([
        //     'id' => Str::uuid(),
        //     'kelompokId' => '9e24e5d6-2648-46f3-9ebd-6185adfce575',
        //     'mahasiswaId' => '9e2ac5e7-8697-4e31-bdd8-812e9a494aab',
        //     'status_mahasiswa' => 'anggota',
        // ]);
        DB::table('mahasiswa_kelompok')->insert([
            'id' => Str::uuid(),
            'kelompokId' => '9e24e5d6-2648-46f3-9ebd-6185adfce575',
            'mahasiswaId' => '9e2d5e84-bfdb-4876-8ab1-018c20bed746',
            'status_mahasiswa' => 'anggota',
        ]);
    }
}
