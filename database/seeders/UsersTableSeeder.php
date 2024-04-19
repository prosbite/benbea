<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Joy',
            'email' => 'joy@benbea.com',
            'password' => Hash::make('Joy@BenBea'), // Hash the password
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Jen',
            'email' => 'jen@benbea.com',
            'password' => Hash::make('Jen@BenBea'), // Hash the password
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Leone',
            'email' => 'leone@benbea.com',
            'password' => Hash::make('admin@Leone0826'), // Hash the password
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'Gret',
            'email' => 'gret@benbea.com',
            'password' => Hash::make('admin@Gret0826'), // Hash the password
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
