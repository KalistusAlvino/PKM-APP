<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodi')->insert([
            [
                'fakultas_id' => 1,
                'nama_prodi' => 'Filsafat Keahlian Program Sarjana'
            ],
            [
                'fakultas_id' => 1,
                'nama_prodi' => 'Filsafat Keahlian Program Magister'
            ],
            [
                'fakultas_id' => 1,
                'nama_prodi' => 'Doktor Teologi'
            ],
            [
                'fakultas_id' => 1,
                'nama_prodi' => 'Indonesian Consortium for Religious Studies (ICRS)'
            ],
            [
                'fakultas_id' => 2,
                'nama_prodi' => 'Arsitektur'
            ],
            [
                'fakultas_id' => 2,
                'nama_prodi' => 'Desain Produk'
            ],
            [
                'fakultas_id' => 2,
                'nama_prodi' => 'Magister Arsitektur'
            ],
            [
                'fakultas_id' => 3,
                'nama_prodi' => 'Biologi'
            ],
            [
                'fakultas_id' => 4,
                'nama_prodi' => 'Manajemen'
            ],
            [
                'fakultas_id' => 4,
                'nama_prodi' => 'Akutansi'
            ],
            [
                'fakultas_id' => 4,
                'nama_prodi' => 'Magister Manajemen'
            ],
            [
                'fakultas_id' => 5,
                'nama_prodi' => 'Informatika'
            ],
            [
                'fakultas_id' => 5,
                'nama_prodi' => 'Sistem Informasi'
            ],
            [
                'fakultas_id' => 6,
                'nama_prodi' => 'Kedokteran'
            ],
            [
                'fakultas_id' => 6,
                'nama_prodi' => 'Profesi Dokter'
            ],
            [
                'fakultas_id' => 7,
                'nama_prodi' => 'Pendidikan Bahasa Inggris'
            ],
            [
                'fakultas_id' => 7,
                'nama_prodi' => 'Studi Humanitas'
            ],
        ]);
    }
}
