<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use App\Models\Nasabah;
use App\Models\PoinNasabah;
use App\Models\Point;
use App\Models\Sampah;
use App\Models\TukarPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class PemasukanSampahController extends Controller
{
    public function index()
    {
        $sampah = Sampah::where('admin_id', Auth::user()->admin->id)->get();
        $kategorisampah = KategoriSampah::where('admin_id', Auth::user()->admin->id)->get();
        $poin = Point::where('admin_id', Auth::user()->admin->id)->get();
        $nasabah = Nasabah::all();
        $data = [
            'sampah'  => $sampah,
            'nasabah'  => $nasabah,
            'kategorisampah'  => $kategorisampah,
            'poin'  => $poin,
        ];
        return view('admin.pemasukan sampah.index', $data);
    }
    public function store(Request $request)
    {
        $params1 = $request->all();
        if ($request->input('nasabah_id') == null) {
            $params1['status'] = 'datang langsung';
            $params1['admin_id'] = Auth::user()->admin->id;
            $params1['instansi'] = Auth::user()->admin->instansi;
            $params1['tanggal'] = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $point = KategoriSampah::where('id', $request->input('poin_id'))->first();
            $params1['kategori_sampah_id'] = $point->id;
            $tambahsampah = Sampah::create($params1);
            if ($tambahsampah) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                alert()->error('Error', 'Data Berhasil Disimpan');
            }
        } else {
            $params1['status'] = 'datang langsung dengan nasabah';
            $params1['admin_id'] = Auth::user()->admin->id;
            $params1['instansi'] = Auth::user()->admin->instansi;
            $params1['tanggal'] = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $point = KategoriSampah::where('id', $request->input('poin_id'))->first();
            $params1['kategori_sampah_id'] = $point->id;
            $tambahsampah = Sampah::create($params1);
            $caripoint = PoinNasabah::where('nasabah_id', $request->input('nasabah_id'))->first();
            $hitungpoin = ($tambahsampah->pemasukan_sampah * $point->poin_sampah) / $point->berat_sampah;
            $totalpoin = $caripoint->total + $hitungpoin;
            $params2 = ['total' => $totalpoin,];
            $caripoint->update($params2);
            $params3 = [
                'kategori_sampah_id' => $tambahsampah->kategori_sampah_id,
                'sampah_id' => $tambahsampah->id,
                'admin_id' => Auth::user()->admin->id,
                'nasabah_id' => $request->input('nasabah_id'),
                'tanggal' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'status' => 'penambahan poin',
                'instansi' => Auth::user()->admin->instansi,
                'tambah_poin' => $hitungpoin,
            ];
            $tambahpoin = TukarPoint::create($params3);
            if ($tambahsampah && $caripoint && $tambahpoin) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                alert()->error('Error', 'Data Gagal Disimpan');
            }
        }
        return redirect()->route('Admin.pemasukan-sampah.index');
    }
    public function update(Request $request, $id)
    {
        $params1 = $request->all();
        $carisampah = Sampah::findOrFail(Crypt::decrypt($id));
        // dd($carisampah);
        if ($request->input('nasabah_id') == null) {
            $params1['tanggal'] = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $point = KategoriSampah::where('id', $request->input('poin_id'))->first();
            $params1['kategori_sampah_id'] = $point->id;
            $ubahsampah = $carisampah->update($params1);
            if ($ubahsampah) {
                alert()->success('Success', 'Data Berhasil Diubah');
            } else {
                alert()->error('Error', 'Data Gagal Diubah');
            }
        } else {
            // $params1['tanggal'] = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $point = KategoriSampah::where('id', $request->input('poin_id'))->first();
            $params1['kategori_sampah_id'] = $point->id;
            $ubahsampah = $carisampah->update($params1);
            $caripoint = PoinNasabah::where('nasabah_id', $request->input('nasabah_id'))->first();
            $hitungpoin = ($request->input('pemasukan_sampah') * $point->poin_sampah) / $point->berat_sampah;
            $caritambahpoin = TukarPoint::where('sampah_id', Crypt::decrypt($id))->first();
            // dd($caritambahpoin->tambah_poin);
            $kurangipoin = $caripoint->total - $caritambahpoin->tambah_poin;
            $totalpoin = $hitungpoin + $kurangipoin;
            $params2 = ['total' => $totalpoin,];
            $caripoint->update($params2);

            // dd($caritambahpoin);
            $params3 = ['tambah_poin' => $hitungpoin];
            if ($ubahsampah && $caripoint && $caritambahpoin->update($params3)) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                alert()->error('Error', 'Data Gagal Disimpan');
            }
        }
        return redirect()->route('Admin.pemasukan-sampah.index');
    }
}
