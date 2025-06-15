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
        // Buat satu kelompok saja (Kelompok 1)
        $kelompok = Kelompok::create([
            'dospemId' => null,
        ]);

        // === Clara (Ketua) ===
        $user1 = User::create([
            'username' => '72230607',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa1 = Mahasiswa::create([
            'userId' => $user1->id,
            'name' => 'Clara Angelita Karunia Dewi',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230607@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567890',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'ketua',
             'tahun_daftar' => now()->year,
        ]);

        // === Jhosua (Anggota) ===
        $user2 = User::create([
            'username' => '72230617',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa2 = Mahasiswa::create([
            'userId' => $user2->id,
            'name' => 'Jhosua Andrean Mulyadinata',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230617@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567891',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok->id,
            'mahasiswaId' => $mahasiswa2->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Alexander (Anggota) ===
        $user3 = User::create([
            'username' => '72240684',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa3 = Mahasiswa::create([
            'userId' => $user3->id,
            'name' => 'Alexander Tristan Ardi Wiratarman',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72240684@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567892',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok->id,
            'mahasiswaId' => $mahasiswa3->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Missel (Anggota) ===
        $user4 = User::create([
            'username' => '72240714',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa4 = Mahasiswa::create([
            'userId' => $user4->id,
            'name' => 'Missel Miracle Amir',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72240714@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567893',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok->id,
            'mahasiswaId' => $mahasiswa4->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // Buat satu kelompok (Kelompok 2)
        $kelompok2 = Kelompok::create([
            'dospemId' => null,
        ]);

        // === Yohanes Wisnu Chrisandaru (Ketua) ===
        $user1 = User::create([
            'username' => '72240706',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa1 = Mahasiswa::create([
            'userId' => $user1->id,
            'name' => 'Yohanes Wisnu Chrisandaru',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72240706@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567901',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok2->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'ketua',
             'tahun_daftar' => now()->year,
        ]);

        // === Victor Kenji Santoso ===
        $user2 = User::create([
            'username' => '72240676',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa2 = Mahasiswa::create([
            'userId' => $user2->id,
            'name' => 'Victor Kenji Santoso',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72240676@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567902',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok2->id,
            'mahasiswaId' => $mahasiswa2->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Gregorius Daniel Jodan Perminas ===
        $user3 = User::create([
            'username' => '71230970',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa3 = Mahasiswa::create([
            'userId' => $user3->id,
            'name' => 'Gregorius Daniel Jodan Perminas',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '71230970@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567903',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok2->id,
            'mahasiswaId' => $mahasiswa3->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Gabriel Sachio Atmadjaja ===
        $user4 = User::create([
            'username' => '71231052',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa4 = Mahasiswa::create([
            'userId' => $user4->id,
            'name' => 'Gabriel Sachio Atmadjaja',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '71231052@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567904',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok2->id,
            'mahasiswaId' => $mahasiswa4->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // Buat kelompok 3
        $kelompok3 = Kelompok::create([
            'dospemId' => null,
        ]);

        // === Febby (Ketua) ===
        $user1 = User::create([
            'username' => '72230631',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa1 = Mahasiswa::create([
            'userId' => $user1->id,
            'name' => 'Febby',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230631@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567905',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok3->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'ketua',
             'tahun_daftar' => now()->year,
        ]);

        // === Elva (Anggota) ===
        $user2 = User::create([
            'username' => '72230609',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa2 = Mahasiswa::create([
            'userId' => $user2->id,
            'name' => 'Elva',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230609@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567906',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok3->id,
            'mahasiswaId' => $mahasiswa2->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Nala (Anggota) ===
        $user3 = User::create([
            'username' => '72230639',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa3 = Mahasiswa::create([
            'userId' => $user3->id,
            'name' => 'Nala',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230639@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567907',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok3->id,
            'mahasiswaId' => $mahasiswa3->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Citta (Anggota) ===
        $user4 = User::create([
            'username' => '72240688',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa4 = Mahasiswa::create([
            'userId' => $user4->id,
            'name' => 'Citta',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72240688@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567908',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok3->id,
            'mahasiswaId' => $mahasiswa4->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // Buat kelompok 4
        $kelompok4 = Kelompok::create([
            'dospemId' => null,
        ]);

        // === Edwin (Ketua) ===
        $user1 = User::create([
            'username' => '11221217',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa1 = Mahasiswa::create([
            'userId' => $user1->id,
            'name' => 'Edwin',
            'fakultas' => 'Fakultas Bisnis',
            'prodi' => 'Manajemen',
            'email' => '11221217@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567909',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok4->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'ketua',
             'tahun_daftar' => now()->year,
        ]);

        // === Gabriel (Anggota) ===
        $user2 = User::create([
            'username' => '41240880',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa2 = Mahasiswa::create([
            'userId' => $user2->id,
            'name' => 'Gabriel',
            'fakultas' => 'Fakultas Kedokteran',
            'prodi' => 'Kedokteran',
            'email' => '41240880@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567910',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok4->id,
            'mahasiswaId' => $mahasiswa2->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Irawan (Anggota) ===
        $user3 = User::create([
            'username' => '11241531',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa3 = Mahasiswa::create([
            'userId' => $user3->id,
            'name' => 'Irawan',
            'fakultas' => 'Fakultas Bisnis',
            'prodi' => 'Manajemen',
            'email' => '11241531@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567911',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok4->id,
            'mahasiswaId' => $mahasiswa3->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Putry (Anggota) ===
        $user4 = User::create([
            'username' => '12240799',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa4 = Mahasiswa::create([
            'userId' => $user4->id,
            'name' => 'Putry',
            'fakultas' => 'Fakultas Bisnis',
            'prodi' => 'Akutansi',
            'email' => '12240799@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567912',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok4->id,
            'mahasiswaId' => $mahasiswa4->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // Buat kelompok 5
        $kelompok5 = Kelompok::create([
            'dospemId' => null,
        ]);

        // === Dex Bennett (Ketua) ===
        $user1 = User::create([
            'username' => '72230663',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa1 = Mahasiswa::create([
            'userId' => $user1->id,
            'name' => 'Dex Bennett',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230663@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567913',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok5->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'ketua',
             'tahun_daftar' => now()->year,
        ]);

        // === Dave Aryanda Agape (Anggota) ===
        $user2 = User::create([
            'username' => '72230629',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa2 = Mahasiswa::create([
            'userId' => $user2->id,
            'name' => 'Dave Aryanda Agape',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230629@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567914',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok5->id,
            'mahasiswaId' => $mahasiswa2->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Stevanus Denko Firdo Ananda (Anggota) ===
        $user3 = User::create([
            'username' => '72230633',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa3 = Mahasiswa::create([
            'userId' => $user3->id,
            'name' => 'Stevanus Denko Firdo Ananda',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230633@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567915',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok5->id,
            'mahasiswaId' => $mahasiswa3->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Esther Sitindaon (Anggota) ===
        $user4 = User::create([
            'username' => '72240716',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa4 = Mahasiswa::create([
            'userId' => $user4->id,
            'name' => 'Esther Sitindaon',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72240716@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567916',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok5->id,
            'mahasiswaId' => $mahasiswa4->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);
        // Buat kelompok 6
        $kelompok6 = Kelompok::create([
            'dospemId' => null,
        ]);

        // === Levina Leunora Kawer (Ketua) ===
        $user1 = User::create([
            'username' => '11221326',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa1 = Mahasiswa::create([
            'userId' => $user1->id,
            'name' => 'Levina Leunora Kawer',
            'fakultas' => 'Fakultas Bisnis',
            'prodi' => 'Manajemen',
            'email' => '11221326@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567917',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok6->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'ketua',
             'tahun_daftar' => now()->year,
        ]);

        // === Angelica Ohee (Anggota) ===
        $user2 = User::create([
            'username' => '11221278',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa2 = Mahasiswa::create([
            'userId' => $user2->id,
            'name' => 'Angelica Ohee',
            'fakultas' => 'Fakultas Bisnis',
            'prodi' => 'Manajemen',
            'email' => '11221278@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567918',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok6->id,
            'mahasiswaId' => $mahasiswa2->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Amelia Monika Rumbiak (Anggota) ===
        $user3 = User::create([
            'username' => '12220689',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa3 = Mahasiswa::create([
            'userId' => $user3->id,
            'name' => 'Amelia Monika Rumbiak',
            'fakultas' => 'Fakultas Bisnis',
            'prodi' => 'Akutansi',
            'email' => '12220689@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567919',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok6->id,
            'mahasiswaId' => $mahasiswa3->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Kadek Masayu Anindita Purnawan (Anggota) ===
        $user4 = User::create([
            'username' => '41240863',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa4 = Mahasiswa::create([
            'userId' => $user4->id,
            'name' => 'Kadek Masayu Anindita Purnawan',
            'fakultas' => 'Fakultas Kedokteran',
            'prodi' => 'Kedokteran',
            'email' => '41240863@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567920',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok6->id,
            'mahasiswaId' => $mahasiswa4->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);
        // Buat kelompok 7
        $kelompok7 = Kelompok::create([
            'dospemId' => null,
        ]);

        // === Nicholas Dwinata (Ketua) ===
        $user1 = User::create([
            'username' => '71220869',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa1 = Mahasiswa::create([
            'userId' => $user1->id,
            'name' => 'Nicholas Dwinata',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Informatika',
            'email' => '71220869@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567925',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok7->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'ketua',
             'tahun_daftar' => now()->year,
        ]);

        // === Stefani Hartanto (Anggota) ===
        $user2 = User::create([
            'username' => '71220821',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa2 = Mahasiswa::create([
            'userId' => $user2->id,
            'name' => 'Stefani Hartanto',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Informatika',
            'email' => '71220821@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567926',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok7->id,
            'mahasiswaId' => $mahasiswa2->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Angela Sekar Widelia (Anggota) ===
        $user3 = User::create([
            'username' => '71220885',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa3 = Mahasiswa::create([
            'userId' => $user3->id,
            'name' => 'Angela Sekar Widelia',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Informatika',
            'email' => '71220885@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567927',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok7->id,
            'mahasiswaId' => $mahasiswa3->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Ivan Roberto Halim (Anggota) ===
        $user4 = User::create([
            'username' => '71230986',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa4 = Mahasiswa::create([
            'userId' => $user4->id,
            'name' => 'Ivan Roberto Halim',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Informatika',
            'email' => '71230986@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567928',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok7->id,
            'mahasiswaId' => $mahasiswa4->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // Buat kelompok 8
        $kelompok8 = Kelompok::create([
            'dospemId' => null,
        ]);

        // === Jovan Marllen Yulianto (Ketua) ===
        $user1 = User::create([
            'username' => '72230608',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa1 = Mahasiswa::create([
            'userId' => $user1->id,
            'name' => 'Jovan Marllen Yulianto',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230608@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567930',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok8->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'ketua',
             'tahun_daftar' => now()->year,
        ]);

        // === Amazya Grazya Simange (Anggota) ===
        $user2 = User::create([
            'username' => '72230659',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa2 = Mahasiswa::create([
            'userId' => $user2->id,
            'name' => 'Amazya Grazya Simange',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230659@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567931',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok8->id,
            'mahasiswaId' => $mahasiswa2->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Yohanes Wisnu Chrisandaru (Anggota) ===
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok8->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Sianne Fortunata (Anggota) ===
        $user4 = User::create([
            'username' => '61230784',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa4 = Mahasiswa::create([
            'userId' => $user4->id,
            'name' => 'Sianne Fortunata',
            'fakultas' => 'Fakultas Arsitektur dan Desain',
            'prodi' => 'Arsitektur',
            'email' => '61230784@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567933',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok8->id,
            'mahasiswaId' => $mahasiswa4->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // Buat kelompok 9
        $kelompok9 = Kelompok::create([
            'dospemId' => null,
        ]);

        // === Filistera Santoso (Ketua) ===
        $user1 = User::create([
            'username' => '72220525',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa1 = Mahasiswa::create([
            'userId' => $user1->id,
            'name' => 'Filistera Santoso',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72220525@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567940',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok9->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'ketua',
             'tahun_daftar' => now()->year,
        ]);

        // === Andreas Setiawan (Anggota) ===
        $user2 = User::create([
            'username' => '72220581',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa2 = Mahasiswa::create([
            'userId' => $user2->id,
            'name' => 'Andreas Setiawan',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72220581@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567941',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok9->id,
            'mahasiswaId' => $mahasiswa2->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Mario Aditya K (Anggota) ===
        $user3 = User::create([
            'username' => '72220577',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa3 = Mahasiswa::create([
            'userId' => $user3->id,
            'name' => 'Mario Aditya K',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72220577@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567942',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok9->id,
            'mahasiswaId' => $mahasiswa3->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Rafael Evan K (Anggota) ===
        $user4 = User::create([
            'username' => '72230610',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa4 = Mahasiswa::create([
            'userId' => $user4->id,
            'name' => 'Rafael Evan K',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '72230610@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234567943',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok9->id,
            'mahasiswaId' => $mahasiswa4->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);
        // Buat kelompok 10
        $kelompok10 = Kelompok::create([
            'dospemId' => null,
        ]);

        // === Angelina Dwi Rossarita (Ketua) ===
        $user1 = User::create([
            'username' => '31220447',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa1 = Mahasiswa::create([
            'userId' => $user1->id,
            'name' => 'Angelina Dwi Rossarita',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '31220447@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234568001',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok10->id,
            'mahasiswaId' => $mahasiswa1->id,
            'status_mahasiswa' => 'ketua',
             'tahun_daftar' => now()->year,
        ]);

        // === Tiara Shaman Datu (Anggota) ===
        $user2 = User::create([
            'username' => '31220477',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa2 = Mahasiswa::create([
            'userId' => $user2->id,
            'name' => 'Tiara Shaman Datu',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '31220477@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234568002',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok10->id,
            'mahasiswaId' => $mahasiswa2->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Angelica Sharlotte Baikole (Anggota) ===
        $user3 = User::create([
            'username' => '31240532',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa3 = Mahasiswa::create([
            'userId' => $user3->id,
            'name' => 'Angelica Sharlotte Baikole',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '31240532@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234568003',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok10->id,
            'mahasiswaId' => $mahasiswa3->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Maria Meliana Elisabet Br Manik Huruk (Anggota) ===
        $user4 = User::create([
            'username' => '31220460',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa4 = Mahasiswa::create([
            'userId' => $user4->id,
            'name' => 'Maria Meliana Elisabet Br Manik Huruk',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '31220460@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234568004',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok10->id,
            'mahasiswaId' => $mahasiswa4->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

        // === Deciana Grace Abanat (Anggota) ===
        $user5 = User::create([
            'username' => '31220472',
            'role' => 'mahasiswa',
            'password' => bcrypt('12345678'),
        ]);
        $mahasiswa5 = Mahasiswa::create([
            'userId' => $user5->id,
            'name' => 'Deciana Grace Abanat',
            'fakultas' => 'Fakultas Teknologi Informasi',
            'prodi' => 'Sistem Informasi',
            'email' => '31220472@students.ukdw.ac.id',
            'email_verification_at' => now(),
            'no_wa' => '081234568005',
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok10->id,
            'mahasiswaId' => $mahasiswa5->id,
            'status_mahasiswa' => 'anggota',
             'tahun_daftar' => now()->year,
        ]);

    }

}
