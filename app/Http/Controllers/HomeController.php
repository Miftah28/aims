<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use App\Models\Lokasi;
use App\Models\Petugas;
use App\Models\Sampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'superadmin') {

            return view('super admin.home');
            // return view('home');
        } else if (auth()->user()->role == 'admin') {
            $petugas = Petugas::where('admin_id', Auth::user()->admin->id)->get();
            $sampah = [];
            foreach ($petugas as $petugassampah) {
                $sampahpetugas = Sampah::where('petugas_id', $petugassampah->id)
                    ->whereYear('created_at', now()->year)
                    ->sum('pemasukan_sampah');
                $sampah[] = [
                    'petugas' => $petugassampah->name, // Menggunakan $lokusItem->nama_lokus
                    'count' => $sampahpetugas,
                ];
            }
            // dd($sampah);
            $kategori = KategoriSampah::where('admin_id', Auth::user()->admin->id)->get();
            $kategorisampah = [];
            foreach ($kategori as $kategorisampahs) {
                $sampahkategori = Sampah::where('kategori_sampah_id', $kategorisampahs->id)
                    ->whereYear('created_at', now()->year)
                    ->sum('pemasukan_sampah');
                $kategorisampah[] = [
                    'kategori' => $kategorisampahs->jenis_sampah, // Menggunakan $lokusItem->nama_lokus
                    'count' => $sampahkategori,
                ];
            }
            // dd($kategorisampah);
            $lokasi = Lokasi::where('admin_id', Auth::user()->admin->id)->get();
            $lokasisampah = [];
            foreach ($lokasi as $lokasisampahs) {
                $sampahlokasi = Sampah::where('lokasi_id', $lokasisampahs->id)
                    ->whereYear('created_at', now()->year)
                    ->sum('pemasukan_sampah');
                $lokasisampah[] = [
                    'tempat' => $lokasisampahs->tempat, // Menggunakan $lokusItem->nama_lokus
                    'count' => $sampahlokasi,
                ];
            }
            // dd($lokasisampah);
            $sampahperbulan = [];
            for ($i = 0; $i < 12; $i++) {
                $lokasisampahBulan = Sampah::whereMonth('tanggal', $i + 1)
                    ->whereYear('created_at', now()->year)
                    ->sum('pemasukan_sampah');

                $sampahperbulan[] = $lokasisampahBulan;
            }
            // dd($lokasi);
            $data = [
                'petugas' => $sampah,
                'kategori' => $kategorisampah,
                'sampahperbulan' => $sampahperbulan,
                'lokasisampah' => $lokasisampah,
            ];
            return view('admin.home', $data);
            // return view('home');
        }
    }
}
