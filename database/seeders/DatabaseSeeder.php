<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'Admin Presensi',
            'username' => 'admin',
            'email' => 'admin@default.com',
            'role'  => 'Admin',
            'password' => Hash::make('password123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Mona Heart',
            'username' => 'mona',
            'email' => 'mona@gmail.com',
            'role'  => 'Pegawai',
            'password' => Hash::make('password'),
        ]);


        DB::table('users')->insert([
            'name' => 'Jhon Forbes',
            'username' => 'jhonforbes',
            'email' => 'jhon@gmail.com',
            'role'  => 'Pegawai',
            'password' => Hash::make('password'),
        ]);

    }
}
