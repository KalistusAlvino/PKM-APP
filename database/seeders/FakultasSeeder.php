<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fakultas')->insert([
            ['nama_fakultas' => 'Fakultas Teologi'],
            ['nama_fakultas' => 'Fakultas Arsitektur dan Desain'],
            ['nama_fakultas' => 'Fakultas Bioteknologi'],
            ['nama_fakultas' => 'Fakultas Bisnis'],
            ['nama_fakultas' => 'Fakultas Teknologi Informasi'],
            ['nama_fakultas' => 'Fakultas Kedokteran'],
            ['nama_fakultas' => 'Fakultas Kependidikan dan Humaniora'],
        ]);
    }
}
