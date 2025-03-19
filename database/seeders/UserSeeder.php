<?php

namespace Database\Seeders;

use App\Models\Biro;
use App\Models\Koordinator;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'koordinator1',
            'role' => 'koordinator',
            'password' => bcrypt('12345678'),
        ]);
        Koordinator::create([
            'userId' => $user->id,
            'name' => 'Koordinator Satu',
        ]);
        $user = User::create([
            'username' => 'biro1',
            'role' => 'biro',
            'password' => bcrypt('12345678'),
        ]);
        Biro::create([
            'userId' => $user->id,
            'name' => 'Biro Satu',
        ]);
    }
}
