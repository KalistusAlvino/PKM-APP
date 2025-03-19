<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class SkemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skema_pkm')->insert([
            [
                'id' => Str::uuid(),
                'nama_skema' => 'PKM-PM'
            ],
            [
                'id' => Str::uuid(),
                'nama_skema' => 'PKM-AI'
            ],
            [
                'id' => Str::uuid(),
                'nama_skema' => 'PKM-RE'
            ],
            [
                'id' => Str::uuid(),
                'nama_skema' => 'PKM-KC'
            ],
            [
                'id' => Str::uuid(),
                'nama_skema' => 'PKM-PI'
            ],
            [
                'id' => Str::uuid(),
                'nama_skema' => 'PKM-VGK'
            ],
        ]);
    }
}
