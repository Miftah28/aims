<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Petugas;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'username' => 'superadmin',
            'status' => 'aktif',
            'password' => bcrypt('123456789'),
            'role' => 'superadmin',
        ]);
        if ($user) {
            SuperAdmin::create([
                'name' => 'Administrator',
                'user_id' => $user->id,
                // 'dinas_id' => $dinas->id,
            ]);
        }
        $user = User::create([
            'username' => 'admin@gmail.com',
            'status' => 'aktif',
            'password' => bcrypt('123456789'),
            'role' => 'admin',
        ]);
        if ($user) {
            $admin = Admin::create([
                'name' => 'admin',
                'user_id' => $user->id,
                'instansi' => 'DLH',
            ]);
        }
        $user = User::create([
            'username' => 'petugas1@gmail.com',
            'status' => 'aktif',
            'password' => bcrypt('123456789'),
            'role' => 'petugas',
        ]);
        if ($user) {
            Petugas::create([
                'name' => 'petugas1',
                'no_hp' => '08675756',
                // 'email' => 'petugas@petugas.com',
                'alamat' => 'jalan nanas',
                'admin_id' => $admin->id,
                'user_id' => $user->id,
            ]);
        }
        $user = User::create([
            'username' => 'admin1@gmail.com',
            'status' => 'aktif',
            'password' => bcrypt('123456789'),
            'role' => 'admin',
        ]);
        if ($user) {
            $admin = Admin::create([
                'name' => 'admin1',
                'user_id' => $user->id,
                'instansi' => 'DLH1',
            ]);
        }
        $user = User::create([
            'username' => 'petugas11@gmail.com',
            'status' => 'aktif',
            'password' => bcrypt('123456789'),
            'role' => 'petugas',
        ]);
        if ($user) {
            Petugas::create([
                'name' => 'petugas11',
                'no_hp' => '086757536',
                // 'email' => 'petugas1@petugas.com',
                'alamat' => 'jalan nanas',
                'admin_id' => $admin->id,
                'user_id' => $user->id,
            ]);
        }
        $user = User::create([
            'username' => 'petugas22@gmail.com',
            'status' => 'aktif',
            'password' => bcrypt('123456789'),
            'role' => 'petugas',
        ]);
        if ($user) {
            Petugas::create([
                'name' => 'petugas22',
                'no_hp' => '08675753648739',
                // 'email' => 'petugas22@petugas.com',
                'alamat' => 'jalan nanas',
                'admin_id' => $admin->id,
                'user_id' => $user->id,
            ]);
        }
    }
}
