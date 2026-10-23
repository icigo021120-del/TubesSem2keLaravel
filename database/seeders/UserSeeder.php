<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 5) as $number) {
            DB::table('users')->updateOrInsert(
                ['email' => sprintf('dummy%02d@smartdisaster.test', $number)],
                [
                    'nama_lengkap' => fake()->name(),
                    'no_telepon' => fake()->numerify('08##########'),
                    'role' => 'mahasiswa',
                    'password_hash' => Hash::make('password123'),
                    'created_at' => now(),
                ],
            );
        }
    }
}
