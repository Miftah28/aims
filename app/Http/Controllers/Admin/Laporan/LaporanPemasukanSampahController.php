<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\TukarPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanPemasukanSampahController extends Controller
{
    public function index()
    {
        $pemasukan = TukarPoint::where('admin_id', Auth::user()->admin->id)->where('status', 'penambahan poin')->get();
        $data['pemasukan'] = $pemasukan;
        return view('admin.laporan.pemasukan sampah.index', $data);
    }

    public function filter(Request $request)
    {
        // Validasi input
        $request->validate([
            'filterdateawal' => 'nullable|date',
            'filterdateakhir' => 'nullable|date',
        ]);

        return DB::transaction(function () use ($request) {
            $datefrom = $request->input('filterdateawal');
            $dateto = $request->input('filterdateakhir');

            $query = TukarPoint::query();

            if ($datefrom && $dateto) {
                $query->whereBetween('tanggal', [$datefrom, $dateto])->where('admin_id', Auth::user()->admin->id)->where('status', 'penambahan poin');
            } elseif ($datefrom) {
                $query->whereDate('tanggal', '>=', $datefrom)->where('admin_id', Auth::user()->admin->id)->where('status', 'penambahan poin');
            } elseif ($dateto) {
                $query->whereDate('tanggal', '<=', $dateto)->where('admin_id', Auth::user()->admin->id)->where('status', 'penambahan poin');
            }

            $filter = $query->get();
            return back()->with([
                'filtering' => $filter,
                'messages' => 'Data berhasil difilter',
                'status' => 'success',
                'datefrom' => $datefrom,
                'dateto' => $dateto,
            ]);
        });
    }
}
