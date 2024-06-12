<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\TukarPoint;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LaporanPoinController extends Controller
{
    public function index()
    {
        $pengeluaran = TukarPoint::where('admin_id', Auth::user()->admin->id)->where('status', 'tukar poin')->get();
        $petugas = Petugas::where('admin_id', Auth::user()->admin->id)->get();
        $data = [
            'pengeluaran' => $pengeluaran,
            'petugas' => $petugas,
        ];
        return view('admin.laporan.pengeluran poin.index', $data);
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
                $query->whereBetween('tanggal', [$datefrom, $dateto])->where('admin_id', Auth::user()->admin->id)->where('status', 'tukar poin');
            } elseif ($datefrom) {
                $query->whereDate('tanggal', '>=', $datefrom)->where('admin_id', Auth::user()->admin->id)->where('status', 'tukar poin');
            } elseif ($dateto) {
                $query->whereDate('tanggal', '<=', $dateto)->where('admin_id', Auth::user()->admin->id)->where('status', 'tukar poin');
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
    public function cetak(Request $request, $id)
    {
        // $petugas = TukarPoint::whereIn('petugas_id', $request->input('petugas'),)->get();
        // dd([
        //     Crypt::decrypt($id),
        //     $request->input('tanggalawal'),
        //     $request->input('tanggalakhir'),
        //     $request->input('role'),
        //     $request->input('petugas'),
        //     $petugas,
        // ]);
        if ($request->input('tanggalawal') === null && $request->input('tanggalakhir') === null && $request->input('role') === null) {
            $laporan = TukarPoint::where('admin_id', Crypt::decrypt($id))->where('status', 'tukar poin')->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pengeluran poin.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pengeluaran-poin-keseluruhan.pdf');
        } else if ($request->input('tanggalawal') != null && $request->input('tanggalakhir') != null && $request->input('role') === null) {
            $request->validate([
                'tanggalawal' => 'nullable|date',
                'tanggalakhir' => 'nullable|date',
            ]);
            $datefrom = $request->input('tanggalawal');
            $dateto = $request->input('tanggalakhir');
            $query = TukarPoint::where('admin_id', Auth::user()->admin->id)
                ->where('status', 'tukar poin');
            if ($datefrom && $dateto) {
                $query->whereBetween('tanggal', [$datefrom, $dateto]);
            }
            $laporan = $query->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pengeluran poin.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pengeluaran-poin-pertanggal.pdf');
        } else if ($request->input('tanggalawal') != null && $request->input('tanggalakhir') != null && $request->input('role') === 'admin') {
            $request->validate([
                'tanggalawal' => 'nullable|date',
                'tanggalakhir' => 'nullable|date',
            ]);
            $datefrom = $request->input('tanggalawal');
            $dateto = $request->input('tanggalakhir');
            $query = TukarPoint::where('admin_id', Auth::user()->admin->id)
                ->where('status', 'tukar poin')->whereNull('petugas_id');
            if ($datefrom && $dateto) {
                $query->whereBetween('tanggal', [$datefrom, $dateto]);
            }
            $laporan = $query->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pengeluran poin.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pengeluaran-poin-peradmin.pdf');
        } else if ($request->input('tanggalawal') != null && $request->input('tanggalakhir') != null && $request->input('role') === 'petugas') {
            $request->validate([
                'tanggalawal' => 'nullable|date',
                'tanggalakhir' => 'nullable|date',
            ]);
            $datefrom = $request->input('tanggalawal');
            $dateto = $request->input('tanggalakhir');
            $query = TukarPoint::where('admin_id', Auth::user()->admin->id)
                ->where('status', 'tukar poin')->whereIn('petugas_id', $request->input('petugas'));
            if ($datefrom && $dateto) {
                $query->whereBetween('tanggal', [$datefrom, $dateto]);
            }
            $laporan = $query->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pengeluran poin.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pengeluaran-poin-perpetugas.pdf');
        } else if ($request->input('tanggalawal') === null && $request->input('tanggalakhir') === null && $request->input('role') === 'admin') {
            $laporan = TukarPoint::where('admin_id', Crypt::decrypt($id))->where('status', 'tukar poin')->whereNull('petugas_id')->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pengeluran poin.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pengeluaran-poin-admin.pdf');
        } else if ($request->input('tanggalawal') === null && $request->input('tanggalakhir') === null && $request->input('role') === 'petugas') {
            $request->validate([
                'petugas' => 'required|array',
                'petugas.*' => 'integer'
            ]);
            $adminId = Crypt::decrypt($id);
            $laporan = TukarPoint::where('admin_id', $adminId)
                ->where('status', 'tukar poin')
                ->whereIn('petugas_id', $request->input('petugas'))
                ->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pengeluran poin.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pengeluaran-poin-petugas.pdf');
        }
    }
}
