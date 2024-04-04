<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
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
            'username' => 'admin',
            'status' => 'aktif',
            'password' => bcrypt('123456789'),
            'role' => 'admin',
        ]);
        if ($user) {
            Admin::create([
                'name' => 'admin',
                'user_id' => $user->id,
                // 'dinas_id' => $dinas->id,
            ]);
        }
    }
}
