<?php

namespace Database\Seeders;

use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jumlahMahasiswa = 20; // Sesuaikan jumlah yang diinginkan
        $usedNims = []; // Untuk menyimpan NIM yang sudah digunakan

        for ($i = 1; $i <= $jumlahMahasiswa; $i++) {
            // Generate NIM acak 8 digit yang unik
            do {
                $nim = mt_rand(10000000, 99999999);
            } while (in_array($nim, $usedNims));

            $usedNims[] = $nim; // Simpan NIM yang sudah digunakan

            // Buat user
            $user = User::create([
                'username' => $nim, // Menggunakan NIM sebagai username
                'role' => 'mahasiswa',
                'password' => Hash::make('password123'),
            ]);

            // Buat mahasiswa
            $mahasiswa = Mahasiswa::create([
                'userId' => $user->id,
                'name' => $this->generateNamaMahasiswa($i),
                'fakultas' => 'Fakultas Teknologi Informasi',
                'prodi' => 'Sistem Informasi',
                'email' => $nim . '@student.example.ac.id',
                'no_wa' => '08' . str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT),
            ]);

            // Buat kelompok baru untuk setiap mahasiswa
            $kelompok = Kelompok::create([
                'dospemId' => null
            ]);

            // Daftarkan mahasiswa sebagai ketua kelompok
            MahasiswaKelompok::create([
                'kelompokId' => $kelompok->id,
                'mahasiswaId' => $mahasiswa->id,
                'status_mahasiswa' => 'ketua',
            ]);
        }
    }
    private function generateNamaMahasiswa($index): string
    {
        $firstNames = ['Ahmad', 'Budi', 'Citra', 'Dewi', 'Eka', 'Fajar', 'Gita', 'Hadi', 'Indra', 'Joko'];
        $lastNames = ['Santoso', 'Wijaya', 'Kusuma', 'Nugroho', 'Pratama', 'Rahardjo', 'Surya', 'Utomo', 'Viani', 'Wibowo'];

        $firstName = $firstNames[($index-1) % count($firstNames)];
        $lastName = $lastNames[($index-1) % count($lastNames)];

        return $firstName . ' ' . $lastName . ' ' . ($index <= 10 ? '' : 'II');
    }
}
