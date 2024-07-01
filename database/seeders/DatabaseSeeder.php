<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\KategoriSampah;
use App\Models\Nasabah;
use App\Models\Petugas;
use App\Models\PoinNasabah;
use App\Models\Point;
use App\Models\Setting;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        // $user = User::create([
        //     'username' => 'admin@gmail.com',
        //     'status' => 'aktif',
        //     'password' => bcrypt('123456789'),
        //     'role' => 'admin',
        // ]);
        // if ($user) {
        //     $admin = Admin::create([
        //         'name' => 'admin',
        //         'user_id' => $user->id,
        //         'instansi' => 'DLH Indramayu',
        //     ]);
        //     KategoriSampah::create([
        //         'admin_id' => $admin->id,
        //         'jenis_sampah' => 'plastik botol',
        //         'berat_sampah' => 1,
        //         'poin_sampah' => 500,
        //     ]);
        //     KategoriSampah::create([
        //         'admin_id' => $admin->id,
        //         'jenis_sampah' => 'alimunium',
        //         'berat_sampah' => 1,
        //         'poin_sampah' => 700,
        //     ]);
        // }
        // $user = User::create([
        //     'username' => 'petugas1@gmail.com',
        //     'status' => 'aktif',
        //     'password' => bcrypt('123456789'),
        //     'role' => 'petugas',
        // ]);
        // if ($user) {
        //     Petugas::create([
        //         'name' => 'petugas1',
        //         'no_hp' => '08675756',
        //         // 'email' => 'petugas@petugas.com',
        //         'alamat' => 'jalan nanas',
        //         'admin_id' => $admin->id,
        //         'user_id' => $user->id,
        //     ]);
        // }
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
                'instansi' => 'DLH Cirebon',
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
        $user = User::create([
            'username' => 'miftahus280206@gmail.com',
            'status' => 'aktif',
            'password' => bcrypt('123456789'),
            'role' => 'nasabah',
        ]);
        if ($user) {
            $nasabah = Nasabah::create([
                'name' => 'miftah',
                'no_hp' => '08675758648739',
                'kode_pengguna' => generateRandomCode(12),
                // 'email' => 'petugas22@petugas.com',
                'alamat' => 'jalan nanas no 28',
                'user_id' => $user->id,
            ]);
            PoinNasabah::create([
                'nasabah_id' => $nasabah->id,
                'total' => 0,
            ]);
        }
        $sourcePath = public_path('assets/admin/img/waste-management.jpg');

        // Define the destination folder and file name
        $destinationFolder = 'uploads/onpige/logo';
        $destinationFileName = 'waste-management.jpg';

        // Ensure the directory exists
        if (!Storage::disk('public')->exists($destinationFolder)) {
            Storage::disk('public')->makeDirectory($destinationFolder);
        }

        // Define the full destination path
        $destinationPath = $destinationFolder . '/' . $destinationFileName;

        // Copy the file to the destination path
        Storage::disk('public')->put($destinationPath, File::get($sourcePath));

        // Create the setting record
        Setting::create([
            'logo' => $destinationPath,
            'nama_aplikasi' => 'CleanEarth',
            'deskripsi' => 'Aplikasi CleanEarth adalah solusi inovatif untuk manajemen sampah di berbagai daerah. Aplikasi ini memungkinkan pengguna untuk mencatat dan mengelola data sampah di lokasi-lokasi tertentu. Selain itu, CleanEarth menawarkan fitur unik yang memungkinkan pengguna untuk menukar sampah yang dapat didaur ulang dengan poin. Poin-poin yang terkumpul kemudian dapat ditukarkan dengan uang tunai, memberikan insentif bagi masyarakat untuk lebih aktif dalam kegiatan daur ulang dan menjaga kebersihan lingkungan. Dengan CleanEarth, pengelolaan sampah menjadi lebih efisien dan memberikan manfaat ekonomi bagi penggunanya.',
            'no_telp' => '087848512592',
            'email' => 'aplikasiaims@gmail.com',
            'alamat' => 'Jalan nanas ',
        ]);
        $this->call([
            KategoriSampahSeeder::class,
        ]);
    }
}
