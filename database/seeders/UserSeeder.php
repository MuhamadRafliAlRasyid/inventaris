<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        User::create([
            'name' => 'Admin sip 1', //untuk menginputkan nama
            'email' => 'admin1@gmail.com', //contoh email untuk admin sip 1
            'password' => Hash::make('admin#sip1'), // contoh password untuk admin1
            'bagian_id' => 1, // Di bagian admin
            'role' => 'admin', // role admin
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        User::create([
            'name' => ' Admin sip 2', //untuk menginputkan nama
            'email' => 'admin2@gmail.com', //contoh email untuk admin sip 2
            'password' => Hash::make('admin#sip2'), // contoh password untuk admin1
            'bagian_id' => 1, // Di bagian admin
            'role' => 'admin', // role admin
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
