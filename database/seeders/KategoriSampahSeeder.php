<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\KategoriSampah;
use App\Models\Petugas;
use App\Models\Point;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
                'instansi' => 'DLH Indramayu',
            ]);

            //kategori sampah
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Botol Plastik',
                'berat_sampah' => 1,
                'poin_sampah' => 2500,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Gelas Plastik',
                'berat_sampah' => 1,
                'poin_sampah' => 3800,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Kemasan Bekas Obat',
                'berat_sampah' => 1,
                'poin_sampah' => 500,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Arsip',
                'berat_sampah' => 1,
                'poin_sampah' => 1800,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Koran Bagus',
                'berat_sampah' => 1,
                'poin_sampah' => 3400,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Dus/Kardus',
                'berat_sampah' => 1,
                'poin_sampah' => 1600,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Dus/Kardus',
                'berat_sampah' => 1,
                'poin_sampah' => 1600,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Kertas Campur',
                'berat_sampah' => 1,
                'poin_sampah' => 400,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Seng',
                'berat_sampah' => 1,
                'poin_sampah' => 2000,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Besi',
                'berat_sampah' => 1,
                'poin_sampah' => 3500,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Alumunium',
                'berat_sampah' => 1,
                'poin_sampah' => 10000,
            ]);
            KategoriSampah::create([
                'admin_id' => $admin->id,
                'jenis_sampah' => 'Beling',
                'berat_sampah' => 1,
                'poin_sampah' => 200,
            ]);

            //poin
            Point::create([
                'admin_id' => $admin->id,
                'jumlah_poin' => 10000,
                'jumlah_saldo' => 10000,
            ]);
            Point::create([
                'admin_id' => $admin->id,
                'jumlah_poin' => 20000,
                'jumlah_saldo' => 20000,
            ]);
            Point::create([
                'admin_id' => $admin->id,
                'jumlah_poin' => 30000,
                'jumlah_saldo' => 30000,
            ]);
            Point::create([
                'admin_id' => $admin->id,
                'jumlah_poin' => 40000,
                'jumlah_saldo' => 40000,
            ]);
            Point::create([
                'admin_id' => $admin->id,
                'jumlah_poin' => 50000,
                'jumlah_saldo' => 50000,
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
                'alamat' => 'jalan nanas',
                'admin_id' => $admin->id,
                'user_id' => $user->id,
            ]);
        }
    }
}
