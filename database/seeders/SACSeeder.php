<?php

namespace Database\Seeders;

use App\Models\Jenis;
use App\Models\Kategori;
use App\Models\Tingkat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SACSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $kegiatan = Kategori::create([
            'id' => Str::uuid(),
            'nama_kategori' => 'KOMPETISI'
        ]);

        $tingkatList = [
            'NON PUPERNAS INTERNASIONAL',
            'NON PUPERNAS NASIONAL',
            'NON PUPERNAS REGIONAL',
            'PUPERNAS',
        ];

        foreach ($tingkatList as $namaTingkat) {
            $tingkat = Tingkat::create([
                'id' => Str::uuid(),
                'id_kategori' => $kegiatan->id,
                'nama_tingkat' => $namaTingkat
            ]);

            Jenis::insert([
                ['id' => Str::uuid(),'id_tingkat' => $tingkat->id, 'nama_jenis' => 'FINAL/FINALIS', 'poin' => 35],
                ['id' => Str::uuid(),'id_tingkat' => $tingkat->id, 'nama_jenis' => 'JUARA 1', 'poin' => 50],
                ['id' => Str::uuid(),'id_tingkat' => $tingkat->id, 'nama_jenis' => 'JUARA 2', 'poin' => 45],
                ['id' => Str::uuid(),'id_tingkat' => $tingkat->id, 'nama_jenis' => 'JUARA 3', 'poin' => 40],
                ['id' => Str::uuid(),'id_tingkat' => $tingkat->id, 'nama_jenis' => 'LOLOS/ DIDANAI', 'poin' => 30],
                ['id' => Str::uuid(),'id_tingkat' => $tingkat->id, 'nama_jenis' => 'PESERTA/PROPOSAL', 'poin' => 10],
            ]);
        }
    }
}
