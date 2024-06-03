<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use App\Models\Nasabah;
use App\Models\PoinNasabah;
use App\Models\Point;
use App\Models\Sampah;
use App\Models\TukarPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringAPIController extends Controller
{
    public function lihatpoin()
    {
        $nasabah = PoinNasabah::where('nasabah_id', Auth::user()->nasabah->id)->first();
        return response()->json([
            'success' => true,
            'data' => [
                'tukar' => $nasabah,
                // 'lokasi' => $lokasi
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }
    public function lihatriwayattukarpoin()
    {
        $nasabah = TukarPoint::where('nasabah_id', Auth::user()->nasabah->id)->get();
        return response()->json([
            'success' => true,
            'data' => [
                'tukar' => $nasabah,
                // 'lokasi' => $lokasi
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }
    public function pemasukansampah()
    {
        $nasabahId = Auth::user()->nasabah->id;
        $totalPemasukanSampah = Sampah::where('nasabah_id', $nasabahId)->count();

        return response()->json([
            'success' => true,
            'data' => [
                'tukar' => $totalPemasukanSampah,
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }

    public function kontribusisampah()
    {
        $nasabahId = Auth::user()->nasabah->id;
        $totalPemasukanSampah = Sampah::where('nasabah_id', $nasabahId)->sum('pemasukan_sampah');

        return response()->json([
            'success' => true,
            'data' => [
                'tukar' => $totalPemasukanSampah,
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }

    public function lihatnasabah()
    {
        $nasabah = Nasabah::all();
        return response()->json([
            'success' => true,
            'data' => [
                'nasabah' => $nasabah,
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }

    public function lihatkategorisampah()
    {
        $kategori = KategoriSampah::where('admin_id', Auth::user()->petugas->admin->id)->get();
        return response()->json([
            'success' => true,
            'data' => [
                'kategori' => $kategori,
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }

    public function lihatkelolapoin()
    {
        $poin = Point::where('admin_id', Auth::user()->petugas->admin->id)->get();
        return response()->json([
            'success' => true,
            'data' => [
                'poin' => $poin,
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }
}
