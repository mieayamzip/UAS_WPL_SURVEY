<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Generate code otomatis 0000001 dst
        $lastCode = User::max('code');
        $newCode = $lastCode ? str_pad((int)$lastCode + 1, 7, '0', STR_PAD_LEFT) : '0000001';

        User::create([
            'code' => $newCode,
            'nik' => '0000000000000000', // nik dummy
            'name' => 'Test User',
            'tanggal_lahir' => '2000-01-01', // default
            'tempat_lahir' => 'Test City', // default
            'alamat' => 'Alamat Test', // default
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
