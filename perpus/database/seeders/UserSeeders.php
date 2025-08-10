<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'akses' => 'admin',
            'image' => null,
        ]);

        // User
        User::create([
            'nama' => 'Pengguna Biasa',
            'username' => 'user',
            'password' => Hash::make('user123'),
            'akses' => 'user',
            'image' => null,
        ]);
    }
}
