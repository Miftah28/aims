<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use App\Models\Nasabah;
use App\Models\PoinNasabah;
use App\Models\Point;
use App\Models\TukarPoint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenukaranPoinController extends Controller
{
    public function index()
    {
        $penukaran = TukarPoint::where('admin_id', Auth::user()->admin->id)->where('status', 'tukar poin')->get();
        $kategori = KategoriSampah::where('admin_id', Auth::user()->admin->id)->get();
        $poin = Point::where('admin_id', Auth::user()->admin->id)->get();
        $nasabah = Nasabah::all();
        $data = [
            'penukaran' => $penukaran,
            'kategori' => $kategori,
            'nasabah' => $nasabah,
            'poin' => $poin,
        ];
        return view('admin.penukaran poin.index', $data);
    }
    public function getTotalPoin($id)
    {
        $nasabah = PoinNasabah::where('nasabah_id', $id);
        if ($nasabah) {
            return response()->json(['total' => $nasabah->total]);
        } else {
            return response()->json(['total' => 0], 404);
        }
    }
    public function tukar(Request $request)
    {
        $params1 = $request->all();
        $caripoint = PoinNasabah::where('nasabah_id', $request->input('nasabah_id'))->first();
        // dd($caripoint->total);
        $lihatpoin = Point::where('id', $request->poin_id)->first();
        $cekpoint = $caripoint->total - $lihatpoin->jumlah_poin;
        // dd($cekpoint);
        if ($caripoint->total == 0 || $cekpoint < 0) {
            alert()->warning('Warning', 'Poin ' . $caripoint->nasabah->name . ' kurang.' . 'Saldo yang dimiliki: ' . $caripoint->total);
        } else {
            $params1['status'] = 'tukar poin';
            $params1['tanggal'] = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $params1['admin_id'] = Auth::user()->admin->id;
            $params1['instansi'] = Auth::user()->admin->instansi;
            $params1['point_id'] = $request->poin_id;
            $params1['kurang_poin'] = $lihatpoin->jumlah_poin;
            // $point = KategoriSampah::where('id', $request->input('poin_id'))->first();
            // $params1['kategori_sampah_id'] = $point->id;
            $tukarpoin = TukarPoint::create($params1);
            $hitungpoin = $caripoint->total - $tukarpoin->kurang_poin;
            $params2 = ['total' => $hitungpoin,];
            $caripoint->update($params2);
            if ($tukarpoin && $caripoint && $caripoint) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                alert()->error('Error', 'Data Gagal Disimpan');
            }
        }

        return redirect()->route('Admin.penukaran-poin.index');
    }
}
