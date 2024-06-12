<?php

use App\Http\Controllers\Admin\Laporan\LaporanPemasukanSampahController;
use App\Http\Controllers\Admin\Laporan\LaporanPoinController;
use App\Http\Controllers\Admin\Manajemen\JadwalTugasController;
use App\Http\Controllers\Admin\Manajemen\KategoriSampahController;
use App\Http\Controllers\Admin\Manajemen\LokasiController;
use App\Http\Controllers\Admin\Manajemen\PoinController;
use App\Http\Controllers\Admin\Manajemen\TugasPetugasController;
use App\Http\Controllers\Admin\Master\ManajemenPetugasController;
use App\Http\Controllers\Admin\Master\MonitoringDataController;
use App\Http\Controllers\Admin\PemasukanSampahController;
use App\Http\Controllers\Admin\PenukaranPoinController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SuperAdmin\ProfileController as superadminprofileController;
use App\Http\Controllers\SuperAdmin\Master\ManajemenAkunController;
use App\Http\Controllers\SuperAdmin\setting\KotakSaranController;
use App\Http\Controllers\SuperAdmin\setting\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.landing page.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// super admin
Route::middleware(['auth', 'user-access:superadmin'])->group(function () {
    // Master
    //  kelola akun super admin, admin dan petugas
    Route::get('superadmin/master/akun', [ManajemenAkunController::class, 'index'])->name('SuperAdmin.master.akun.index');
    Route::post('superadmin/master/akun', [ManajemenAkunController::class, 'store'])->name('SuperAdmin.master.akun.store');
    Route::post('superadmin/master/akun/tambahpetugas/{id}', [ManajemenAkunController::class, 'storepetugas'])->name('SuperAdmin.master.akun.storepetugas');
    Route::put('superadmin/master/akun/{id}', [ManajemenAkunController::class, 'update'])->name('SuperAdmin.master.akun.update');
    Route::put('superadmin/master/akun/editpetugas/{id}', [ManajemenAkunController::class, 'updatepetugas'])->name('SuperAdmin.master.akun.updatepetugas');
    Route::delete('superadmin/master/akun/{id}', [ManajemenAkunController::class, 'destroy'])->name('SuperAdmin.master.akun.destroy');
    Route::delete('superadmin/master/akun/hapuspetugas/{id}', [ManajemenAkunController::class, 'destroypetugas'])->name('SuperAdmin.master.akun.destroypetugas');
    Route::get('superadmin/master/akun/verifikasistatus/{id}', [ManajemenAkunController::class, 'verifikasistatus'])->name('SuperAdmin.master.akun.verifikasistatus');
    Route::get('superadmin/master/akun/unverifikasistatus/{id}', [ManajemenAkunController::class, 'unverifikasistatus'])->name('SuperAdmin.master.akun.unverifikasistatus');
    //  kelola akun nasabah
    Route::get('superadmin/master/akun-nasabah', [ManajemenAkunController::class, 'indexnasabah'])->name('SuperAdmin.master.akun-nasabah.index-nasabah');
    Route::post('superadmin/master/akun-nasabah', [ManajemenAkunController::class, 'storenasabah'])->name('SuperAdmin.master.akun-nasabah.store-nasabah');
    Route::put('superadmin/master/akun-nasabah/{id}', [ManajemenAkunController::class, 'updatenasabah'])->name('SuperAdmin.master.akun-nasabah.update-nasabah');
    Route::delete('superadmin/master/akun-nasabah/{id}', [ManajemenAkunController::class, 'destroynasabah'])->name('SuperAdmin.master.akun-nasabah.destroy-nasabah');

    // Konfirmasi akun
    Route::get('superadmin/konfirmasi-akun', [ManajemenAkunController::class, 'konfirmasiindex'])->name('SuperAdmin.konfirmasi-akun.index');
    Route::put('superadmin/konfirmasi-akun/konfirmasi/{id}', [ManajemenAkunController::class, 'konfirmasi'])->name('SuperAdmin.konfirmasi-akun.konfirmasi');
    Route::put('superadmin/konfirmasi-akun/tolak-konfirmasi/{id}', [ManajemenAkunController::class, 'konfirmasitolak'])->name('SuperAdmin.konfirmasi-akun.tolak-konfirmasi');

    // profile
    Route::get('superadmin/profile', [superadminprofileController::class, 'index'])->name('SuperAdmin.profile.index');
    Route::put('superadmin/profile', [superadminprofileController::class, 'update'])->name('SuperAdmin.profile.update');
    Route::put('superadmin/profile/reset-password', [superadminprofileController::class, 'reset'])->name('SuperAdmin.profile.reset');

    // Setting
    Route::get('superadmin/setting', [SettingController::class, 'index'])->name('SuperAdmin.setting.index');
    Route::put('superadmin/setting', [SettingController::class, 'update'])->name('SuperAdmin.setting.update');
    Route::post('superadmin/setting/team', [SettingController::class, 'createteam'])->name('SuperAdmin.setting.create-team');
    Route::put('superadmin/setting/team/{id}', [SettingController::class, 'updateteam'])->name('SuperAdmin.setting.update-team');
    Route::delete('superadmin/setting/team/{id}', [SettingController::class, 'destroyteam'])->name('SuperAdmin.setting.destroy-team');

    // Kotak saran
    Route::get('superadmin/kotak-saran', [KotakSaranController::class, 'index'])->name('SuperAdmin.Kotak-Saran.index');
});

// admin
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    // penukaran poin
    Route::get('admin/penukaran-poin', [PenukaranPoinController::class, 'index'])->name('Admin.penukaran-poin.index');
    Route::post('admin/penukaran-poin', [PenukaranPoinController::class, 'tukar'])->name('Admin.penukaran-poin.tukar');
    Route::get('/get-nasabah-total-poin/{id}', [PenukaranPoinController::class, 'getTotalPoin']);

    // Pemasukan Sampah
    Route::get('admin/pemasukan-sampah', [PemasukanSampahController::class, 'index'])->name('Admin.pemasukan-sampah.index');
    Route::post('admin/pemasukan-sampah', [PemasukanSampahController::class, 'store'])->name('Admin.pemasukan-sampah.store');
    Route::put('admin/pemasukan-sampah/{id}', [PemasukanSampahController::class, 'update'])->name('Admin.pemasukan-sampah.update');
    Route::delete('admin/pemasukan-sampah/{id}', [PemasukanSampahController::class, 'destroy'])->name('Admin.pemasukan-sampah.destroy');

    // master
    //  kelola akun petugas
    Route::get('admin/master/akun-petugas', [ManajemenPetugasController::class, 'index'])->name('Admin.master.akun-petugas.index');
    Route::post('admin/master/akun-petugas', [ManajemenPetugasController::class, 'store'])->name('Admin.master.akun-petugas.store');
    Route::put('admin/master/akun-petugas/{id}', [ManajemenPetugasController::class, 'update'])->name('Admin.master.akun-petugas.update');
    Route::delete('admin/master/akun-petugas/{id}', [ManajemenPetugasController::class, 'destroy'])->name('Admin.master.akun-petugas.destroy');
    //  verifikasi status akun petugas
    Route::get('admin/master/akun-petugas/verifikasistatus/{id}', [ManajemenPetugasController::class, 'verifikasistatus'])->name('Admin.master.akun-petugas.verifikasistatus');
    Route::get('admin/master/akun-petugas/unverifikasistatus/{id}', [ManajemenPetugasController::class, 'unverifikasistatus'])->name('Admin.master.akun-petugas.unverifikasistatus');
    //  monitoring pemasukan sampah
    Route::get('admin/master/pemasukan-sampah', [MonitoringDataController::class, 'monitoringpemasukansampah'])->name('Admin.master.pemasukan-sampah.index');
    //  monitoring pengeluaran poin
    Route::get('admin/master/pemasukan-pengeluaran-poin', [MonitoringDataController::class, 'monitoringpengeluaranpoin'])->name('Admin.master.pemasukan-pengeluaran-poin.index');

    // Manajemen sampah
    //  kelola poin
    Route::get('admin/manajemen-sampah/kelola-poin', [PoinController::class, 'index'])->name('Admin.manajemen-sampah.kelola-poin.index');
    Route::post('admin/manajemen-sampah/kelola-poin', [PoinController::class, 'store'])->name('Admin.manajemen-sampah.kelola-poin.store');
    Route::put('admin/manajemen-sampah/kelola-poin/{id}', [PoinController::class, 'update'])->name('Admin.manajemen-sampah.kelola-poin.update');
    Route::delete('admin/manajemen-sampah/kelola-poin/{id}', [PoinController::class, 'destroy'])->name('Admin.manajemen-sampah.kelola-poin.destroy');
    //  kelola tempat
    Route::get('admin/manajemen-sampah/kelola-tempat', [LokasiController::class, 'index'])->name('Admin.manajemen-sampah.kelola-tempat.index');
    Route::get('admin/manajemen-sampah/kelola-tempat/create', [LokasiController::class, 'create'])->name('Admin.manajemen-sampah.kelola-tempat.create');
    Route::get('admin/manajemen-sampah/kelola-tempat/edit/{id}', [LokasiController::class, 'edit'])->name('Admin.manajemen-sampah.kelola-tempat.edit');
    Route::post('admin/manajemen-sampah/kelola-tempat/create', [LokasiController::class, 'store'])->name('Admin.manajemen-sampah.kelola-tempat.store');
    Route::put('admin/manajemen-sampah/kelola-tempat/{id}', [LokasiController::class, 'update'])->name('Admin.manajemen-sampah.kelola-tempat.update');
    Route::delete('admin/manajemen-sampah/kelola-tempat/{id}', [LokasiController::class, 'destroy'])->name('Admin.manajemen-sampah.kelola-tempat.destroy');
    //  kelola kategori sampah
    Route::get('admin/manajemen-sampah/ketegori-sampah', [KategoriSampahController::class, 'index'])->name('Admin.manajemen-sampah.ketegori-sampah.index');
    Route::post('admin/manajemen-sampah/ketegori-sampah', [KategoriSampahController::class, 'store'])->name('Admin.manajemen-sampah.ketegori-sampah.store');
    Route::put('admin/manajemen-sampah/ketegori-sampah/{id}', [KategoriSampahController::class, 'update'])->name('Admin.manajemen-sampah.ketegori-sampah.update');
    Route::delete('admin/manajemen-sampah/ketegori-sampah/{id}', [KategoriSampahController::class, 'destroy'])->name('Admin.manajemen-sampah.ketegori-sampah.destroy');
    //  kelola jadwal
    Route::get('admin/manajemen-sampah/kelola-jadwal', [JadwalTugasController::class, 'index'])->name('Admin.manajemen-sampah.kelola-jadwal.index');
    Route::post('admin/manajemen-sampah/kelola-jadwal', [JadwalTugasController::class, 'store'])->name('Admin.manajemen-sampah.kelola-jadwal.store');
    Route::put('admin/manajemen-sampah/kelola-jadwal/{id}', [JadwalTugasController::class, 'update'])->name('Admin.manajemen-sampah.kelola-jadwal.update');
    Route::delete('admin/manajemen-sampah/kelola-jadwal/{id}', [JadwalTugasController::class, 'destroy'])->name('Admin.manajemen-sampah.kelola-jadwal.destroy');
    //  kelola tugas pada petugas
    Route::get('admin/manajemen-sampah/kelola-tugas', [TugasPetugasController::class, 'index'])->name('Admin.manajemen-sampah.kelola-tugas.index');
    Route::post('admin/manajemen-sampah/kelola-tugas{id}', [TugasPetugasController::class, 'store'])->name('Admin.manajemen-sampah.kelola-tugas.store');
    Route::put('admin/manajemen-sampah/kelola-tugas/{id}', [TugasPetugasController::class, 'update'])->name('Admin.manajemen-sampah.kelola-tugas.update');
    Route::delete('admin/manajemen-sampah/kelola-tugas/{id}', [TugasPetugasController::class, 'destroy'])->name('Admin.manajemen-sampah.kelola-tugas.destroy');

    // laporan
    //  laporan penukaran poin nasabah
    Route::get('admin/laporan/penukaran-poin', [LaporanPoinController::class, 'index'])->name('Admin.laporan.penukaran-poin.index');
    Route::post('admin/laporan/penukaran-poin/cetak/{id}', [LaporanPoinController::class, 'cetak'])->name('Admin.laporan.penukaran-poin.cetak');
    Route::post('filter/laporan-penukaran-poin', [LaporanPoinController::class, 'filter'])->name('laporan.poin.filter');
    //  laporan pemasukan sampah
    Route::get('admin/laporan/pemasukan-sampah', [LaporanPemasukanSampahController::class, 'index'])->name('Admin.laporan.pemasukan-sampah.index');
    Route::post('admin/laporan/pemasukan-sampah/cetak/{id}', [LaporanPemasukanSampahController::class, 'cetak'])->name('Admin.laporan.pemasukan-sampah.cetak');
    Route::post('filter/laporan-pemasukan-sampah', [LaporanPemasukanSampahController::class, 'filter'])->name('laporan.sampah.filter');

    // profile
    Route::get('admin/profile', [ProfileController::class, 'index'])->name('Admin.profile.index');
    Route::put('admin/profile', [ProfileController::class, 'update'])->name('Admin.profile.update');
    Route::put('admin/profile/reset-password', [ProfileController::class, 'reset'])->name('Admin.profile.reset');
});

// register
Route::post('register', [RegisterController::class, 'create'])->name('register');
Route::get('register', [RegisterController::class, 'index'])->name('register.index');

// post kotak saran
Route::post('kirim/kotak-saran', [KotakSaranController::class, 'kirim'])->name('kirim.kotak-saran');
