<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('bagian')->insert([
            ['nama' => 'administrasi', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Bagian 2', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Bagian 3', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Bagian 4', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Bagian 5', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
