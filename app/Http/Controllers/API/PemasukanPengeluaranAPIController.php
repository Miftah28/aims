<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JadwalTugas;
use App\Models\KategoriSampah;
use App\Models\Lokasi;
use App\Models\PetugasJemput;
use App\Models\PoinNasabah;
use App\Models\Point;
use App\Models\Sampah;
use App\Models\TukarPoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanPengeluaranAPIController extends Controller
{
    public function lihatlokasi()
    {
        // Mengambil jadwal tugas berdasarkan ID petugas yang sedang login
        $jadwal = PetugasJemput::where('petugas_id', Auth::user()->petugas->id)->with('jadwalTugas')->get();

        // Menginisialisasi array untuk menampung lokasi
        $lokasi = [];

        // Mengambil lokasi dari setiap jadwal tugas yang ditemukan
        foreach ($jadwal as $j) {
            $jadwalTugas = JadwalTugas::where('id', $j->jadwalTugas->id)->with('lokasi')->first();
            if ($jadwalTugas && $jadwalTugas->lokasi) {
                $lokasi[] = $jadwalTugas->lokasi;
            }
        }

        return response()->json([
            'success' => true,
            'data' => [
                'jadwal' => $jadwal,
                'lokasi' => $lokasi
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }
    public function pemasukansampah(Request $request, $id)
    {
        $params1 = $request->all();
        $jadwaltugas = JadwalTugas::where('id', $id)->first();
        $params1['status'] = 'datang ke lokasi yang di tentukan';
        $params1['petugas_id'] = Auth::user()->petugas->id;
        $params1['admin_id'] = Auth::user()->petugas->admin->id;
        $params1['lokasi_id'] = $jadwaltugas->lokasi->id;
        $params1['instansi'] = Auth::user()->petugas->admin->instansi;
        $params1['tanggal'] = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $point = KategoriSampah::where('id', $request->kategori_sampah_id)->first();
        $params1['kategori_sampah_id'] = $request->kategori_sampah_id;
        // dd($request->pemasukan_sampah * $point->poin_sampah);
        $tambahsampah = Sampah::create($params1);
        $caripoint = PoinNasabah::where('nasabah_id', $request->input('nasabah_id'))->first();
        $hitungpoin = $tambahsampah->pemasukan_sampah * $point->poin_sampah;
        $totalpoin = $caripoint->total + $hitungpoin;
        $params2 = ['total' => $totalpoin,];
        $caripoint->update($params2);
        $params3 = [
            // 'kategori_sampah_id' => $tambahsampah->kategori_sampah_id,
            'sampah_id' => $tambahsampah->id,
            'lokasi_id' => $tambahsampah->lokasi->id,
            'petugas_id' => Auth::user()->petugas->id,
            'admin_id' => Auth::user()->petugas->admin->id,
            'nasabah_id' => $request->input('nasabah_id'),
            'tanggal' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            'status' => 'penambahan poin',
            'instansi' => Auth::user()->petugas->admin->instansi,
            'tambah_poin' => $hitungpoin,
        ];
        $tambahpoin = TukarPoint::create($params3);
        if ($tambahpoin && $caripoint && $tambahsampah) {
            return response()->json([
                'success' => true,
                'data' => [
                    'tambahpoin' => $tambahpoin,
                    'caripoint' => $caripoint,
                    'tambahsampah' => $tambahsampah,
                ],
                'message' => 'Sukses simpan'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Gagal simpan data nasabah'
            ], 500);
        }
    }
    public function tukarpoin(Request $request)
    {
        $params1 = $request->all();
        $caripoint = PoinNasabah::where('nasabah_id', $request->input('nasabah_id'))->first();
        // dd($caripoint->total);
        $lihatpoin = Point::where('id', $request->poin_id)->first();
        $cekpoint = $caripoint->total - $lihatpoin->jumlah_poin;
        // dd($cekpoint);
        if ($caripoint->total == 0 || $cekpoint < 0) {
            // alert()->warning('Warning', 'Poin ' . $caripoint->nasabah->name . ' kurang.' . 'Saldo yang dimiliki: ' . $caripoint->total);
            return response()->json([
                'error' => true,
                'message' => 'Saldo kurang'
            ], 500);
        } else {
            $params1['status'] = 'tukar poin';
            $params1['tanggal'] = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $params1['petugas_id'] = Auth::user()->petugas->id;
            $params1['admin_id'] = Auth::user()->petugas->admin->id;
            $params1['instansi'] = Auth::user()->petugas->admin->instansi;
            $params1['point_id'] = $request->poin_id;
            $params1['kurang_poin'] = $lihatpoin->jumlah_poin;
            // $point = KategoriSampah::where('id', $request->input('poin_id'))->first();
            // $params1['kategori_sampah_id'] = $point->id;
            $tukarpoin = TukarPoint::create($params1);
            $hitungpoin = $caripoint->total - $tukarpoin->kurang_poin;
            $params2 = ['total' => $hitungpoin,];
            $caripoint->update($params2);
            if ($tukarpoin && $caripoint) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'tukarpoin' => $tukarpoin,
                        'caripoint' => $caripoint,
                    ],
                    'message' => 'Sukses simpan'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Gagal simpan data nasabah'
                ], 500);
            }
        }
    }
    public function pengajuan(Request $request)
    {
        $params1 = $request->all();
        $caripoint = PoinNasabah::where('nasabah_id', Auth::user()->nasabah->id)->first();
        // dd($caripoint->total);
        $lihatpoin = Point::where('id', $request->poin_id)->first();
        $cekpoint = $caripoint->total - $lihatpoin->jumlah_poin;
        // dd($lihatpoin);
        if ($caripoint->total == 0 || $cekpoint < 0) {
            // alert()->warning('Warning', 'Poin ' . $caripoint->nasabah->name . ' kurang.' . 'Saldo yang dimiliki: ' . $caripoint->total);
            return response()->json([
                'error' => true,
                'message' => 'Saldo kurang'
            ], 500);
        } else {
            $params1['status'] = 'proses';
            $params1['tanggal'] = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            // $params1['petugas_id'] = Auth::user()->petugas->id;
            // $params1['admin_id'] = Auth::user()->petugas->admin->id;
            // $params1['instansi'] = Auth::user()->petugas->admin->instansi;
            $params1['point_id'] = $request->poin_id;
            $params1['kurang_poin'] = $lihatpoin->jumlah_poin;
            $params1['nasabah_id'] = Auth::user()->nasabah->id;
            $params1['instansi'] = 'DLH Indramayu';
            // $point = KategoriSampah::where('id', $request->input('poin_id'))->first();
            // $params1['kategori_sampah_id'] = $point->id;
            $tukarpoin = TukarPoint::create($params1);
            // $hitungpoin = $caripoint->total - $tukarpoin->kurang_poin;
            // $params2 = ['total' => $hitungpoin,];
            // $caripoint->update($params2);
            // if ($tukarpoin && $caripoint) {
            if ($tukarpoin) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'tukarpoin' => $tukarpoin,
                        // 'caripoint' => $caripoint,
                    ],
                    'message' => 'Sukses simpan'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Gagal simpan data nasabah'
                ], 500);
            }
        }
    }
    public function terima(Request $request, $id)
    {
        $params1 = $request->all();
        $caripengajuan = TukarPoint::where('id', $id)->first();
        $caripoint = PoinNasabah::where('nasabah_id', $caripengajuan->nasabah->id)->first();
        // dd($caripoint->total);
        $params1['admin_id'] = Auth::user()->petugas->admin->id;
        $params1['petugas_id'] = Auth::user()->petugas->id;
        $params1['status'] = 'tukar poin';
        $hitungpoin = $caripoint->total - $caripengajuan->kurang_poin;
        $params2 = ['total' => $hitungpoin,];
        $caripoint->update($params2);
        if ($caripengajuan->update($params1) && $caripoint) {
            return response()->json([
                'success' => true,
                'data' => [
                    'tukarpoin' => $caripengajuan,
                    // 'caripoint' => $caripoint,
                ],
                'message' => 'Sukses simpan'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Gagal simpan data nasabah'
            ], 500);
        }
        // dd($params1);
    }
    public function munculkanpoin()
    {
        $poin = Point::where('admin_id', 2)->get();
        return response()->json([
            'success' => true,
            'data' => [
                'poin' => $poin,
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }
    public function lihatriwayattukarpoin()
    {
        $tukar = TukarPoint::where('status', 'tukar poin')->where('petugas_id', Auth::user()->petugas->id)->get();

        return response()->json([
            'success' => true,
            'data' => [
                'tukar' => $tukar,
                // 'lokasi' => $lokasi
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }
}
