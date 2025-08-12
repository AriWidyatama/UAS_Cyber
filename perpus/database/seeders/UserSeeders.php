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

        User::create([
            'nama' => 'Administrator Ke 3',
            'username' => 'admin3',
            'password' => Hash::make('aab'),
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

        User::create([
            'nama' => 'Pengguna Ke 99',
            'username' => 'user9',
            'password' => Hash::make('cr'),
            'akses' => 'user',
            'image' => null,
        ]);
    }
}
