<?php

use App\Models\Admin;
use App\Models\Nasabah;
use App\Models\Petugas;
use App\Models\PetugasJemput;
use App\Models\PoinNasabah;
use App\Models\Point;
use App\Models\Sampah;
use App\Models\Setting;
use App\Models\SuperAdmin;
use App\Models\Team;
use App\Models\TukarPoint;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

if (!function_exists('datapetugas')) {
    function datapetugas($idadmin)
    {
        $results = Petugas::where('admin_id', $idadmin)
            // ->where('type', 'sub lokus')
            ->orderBy('name', 'asc')
            ->get();
        return $results;
    }
}
if (!function_exists('petugas')) {
    function petugas()
    {
        $results = Petugas::all();
        return $results;
    }
}
if (!function_exists('datasuperadmin')) {
    function datasuperadmin($iduser)
    {
        $results = SuperAdmin::where('user_id', $iduser)->first();
        return $results;
    }
}
if (!function_exists('dataadmin')) {
    function dataadmin($iduser)
    {
        $results = Admin::where('user_id', $iduser)->first();
        return $results;
    }
}
if (!function_exists('angkamintaverifikasi')) {
    function angkamintaverifikasi()
    {

        $results = User::where('role', 'admin')->where('status', 'prosess')->orderBy('id', 'asc')->count();
        return $results;
    }
}
if (!function_exists('datamintaverifikasi')) {
    function datamintaverifikasi()
    {
        $results = User::where('role', 'admin')->where('status', 'prosess')->orderBy('id', 'asc')->get();
        return $results;
    }
}
if (!function_exists('datajadwal')) {
    function datajadwal($jadwalid)
    {
        $results = PetugasJemput::where('jadwal_tugas_id', $jadwalid)->get();

        return $results;
    }
}
if (!function_exists('poinsampah')) {
    function poinsampah($jenisSampahId)
    {
        $results = Point::where('kategori_sampah_id', $jenisSampahId)->first();

        return $results;
    }
}
if (!function_exists('poinnasabah')) {
    function poinnasabah($nasabahId)
    {
        $results = PoinNasabah::where('nasabah_id', $nasabahId)->first();

        return $results;
    }
}
if (!function_exists('carinasabah')) {
    function carinasabah($nasabahId)
    {
        $results = Nasabah::where('id', $nasabahId)->first();

        return $results;
    }
}
if (!function_exists('caripoin')) {
    function caripoin($pointId)
    {
        $results = Point::where('id', $pointId)->first();

        return $results;
    }
}
if (!function_exists('generateRandomCode')) {
    function generateRandomCode($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('countadmin')) {
    function countadmin()
    {
        $results = User::where('role', 'admin')->where('status', 'aktif')->count();
        return $results;
    }
}

if (!function_exists('countadminpersen')) {
    function countadminpersen()
    {
        $totalaktif = User::where('role', 'admin')->where('status', 'aktif')->count();
        $total = User::where('role', 'admin')->count();
        $results = ($totalaktif / $total) * 100;
        return $results;
    }
}
if (!function_exists('countpetugas')) {
    function countpetugas()
    {
        $results = User::where('role', 'petugas')->where('status', 'aktif')->count();
        return $results;
    }
}

if (!function_exists('countpetugaspersen')) {
    function countpetugaspersen()
    {
        $totalaktif = User::where('role', 'petugas')->where('status', 'aktif')->count();
        $total = User::where('role', 'petugas')->count();
        $results = ($totalaktif / $total) * 100;
        return $results;
    }
}
if (!function_exists('countnasabah')) {
    function countnasabah()
    {
        $results = User::where('role', 'nasabah')->where('status', 'aktif')->count();
        return $results;
    }
}

if (!function_exists('countnasabahpersen')) {
    function countnasabahpersen()
    {
        $totalaktif = User::where('role', 'nasabah')->where('status', 'aktif')->count();
        $total = User::where('role', 'nasabah')->count();
        $results = ($totalaktif / $total) * 100;
        return $results;
    }
}

if (!function_exists('countpemasukansampah')) {
    function countpemasukansampah()
    {
        $results = Sampah::where('admin_id', Auth::user()->admin->id)->sum('pemasukan_sampah');
        return $results;
    }
}
if (!function_exists('onepige')) {
    function onepige()
    {
        $results = Setting::where('id', 1)->first();
        return $results;
    }
}

if (!function_exists('countpetugasadmin')) {
    function countpetugasadmin()
    {
        $results = User::join('petugas', 'users.id', '=', 'petugas.user_id')
            ->where('users.role', 'petugas')
            ->where('users.status', 'aktif')
            ->where('petugas.admin_id', Auth::user()->admin->id)
            ->count();

        return $results;
    }
}

if (!function_exists('countpetugaspersenadmin')) {
    function countpetugaspersenadmin()
    {
        $totalaktif = User::join('petugas', 'users.id', '=', 'petugas.user_id')
            ->where('users.role', 'petugas')
            ->where('users.status', 'aktif')
            ->where('petugas.admin_id', Auth::user()->admin->id)
            ->count();
        $total = User::join('petugas', 'users.id', '=', 'petugas.user_id')
            ->where('users.role', 'petugas')
            ->where('petugas.admin_id', Auth::user()->admin->id)
            ->count();
        $results = ($totalaktif / $total) * 100;
        return $results;
    }
    if (!function_exists('limit_sentences')) {
        function limit_sentences($text, $limit = 8)
        {
            $sentences = preg_split('/(?<=[.?!])\s+/', $text, $limit + 1, PREG_SPLIT_NO_EMPTY);
            if (count($sentences) > $limit) {
                array_pop($sentences);
                return implode(' ', $sentences) . '...';
            }
            return implode(' ', $sentences);
        }
    }
    if (!function_exists('counttotalsemua')) {
        function counttotalsemua()
        {
            $results = User::where('status', 'aktif')->where('role', '!=', 'superadmin')->count();
            return $results;
        }
    }
    if (!function_exists('team')) {
        function team()
        {
            $results = Team::all();
            return $results;
        }
    }
}
