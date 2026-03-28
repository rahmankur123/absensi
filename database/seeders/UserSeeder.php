<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 🔥 ADMIN
        User::create([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('111111'),
            'role' => 'admin',
            'no_hp' => '08123456789',
            'foto' => null
        ]);

        // 🔥 PELATIH
        User::create([
            'nama' => 'Pelatih',
            'email' => 'pelatih@gmail.com',
            'password' => bcrypt('111111'),
            'role' => 'pelatih',
            'no_hp' => '08987654321',
            'foto' => null
        ]);
    }
}
