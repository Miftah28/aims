<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\Petugas;
use App\Models\TukarPoint;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LaporanPemasukanSampahController extends Controller
{
    public function index()
    {
        $pemasukan = TukarPoint::where('admin_id', Auth::user()->admin->id)->where('status', 'penambahan poin')->get();
        $petugas = Petugas::where('admin_id', Auth::user()->admin->id)->get();
        $lokasi = Lokasi::where('admin_id', Auth::user()->admin->id)->get();
        $data = [
            'pemasukan' => $pemasukan,
            'petugas' => $petugas,
            'lokasi' => $lokasi,
        ];
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

    public function cetak(Request $request, $id)
    {
        // $petugas = TukarPoint::whereIn('petugas_id', $request->input('petugas'))->get();
        // $lokasi = TukarPoint::whereIn('lokasi_id', $request->input('lokasi'))->get();
        // dd([
        //     Crypt::decrypt($id),
        //     $request->input('tanggalawal'),
        //     $request->input('tanggalakhir'),
        //     $request->input('role'),
        //     $request->input('admin'),
        //     $request->input('petugas'),
        //     $petugas,
        //     $lokasi,
        // ]);

        //download pdf semua
        if ($request->input('tanggalawal') === null && $request->input('tanggalakhir') === null && $request->input('role') === null && $request->input('lokasi') === null) {
            $laporan = TukarPoint::where('admin_id', Crypt::decrypt($id))->where('status', 'penambahan poin')->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pemasukan sampah.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pemasukan-sampah-keseluruhan.pdf');
        } else if ($request->input('tanggalawal') != null && $request->input('tanggalakhir') != null && $request->input('role') === null && $request->input('lokasi') === null) {
            // download menurut tanggal saja
            $request->validate([
                'tanggalawal' => 'nullable|date',
                'tanggalakhir' => 'nullable|date',
            ]);
            $datefrom = $request->input('tanggalawal');
            $dateto = $request->input('tanggalakhir');
            $query = TukarPoint::where('admin_id', Auth::user()->admin->id)
                ->where('status', 'penambahan poin');
            if ($datefrom && $dateto) {
                $query->whereBetween('tanggal', [$datefrom, $dateto]);
            }
            $laporan = $query->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pemasukan sampah.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pemasukan-sampah-pertanggal.pdf');
        } else if ($request->input('tanggalawal') != null && $request->input('tanggalakhir') != null && $request->input('role') === 'admin' && $request->input('lokasi') === null) {
            // download menurut tanggal dan role admin
            $request->validate([
                'tanggalawal' => 'nullable|date',
                'tanggalakhir' => 'nullable|date',
            ]);
            $datefrom = $request->input('tanggalawal');
            $dateto = $request->input('tanggalakhir');
            $query = TukarPoint::where('admin_id', Auth::user()->admin->id)
                ->where('status', 'penambahan poin')->whereNull('petugas_id');
            if ($datefrom && $dateto) {
                $query->whereBetween('tanggal', [$datefrom, $dateto]);
            }
            $laporan = $query->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pemasukan sampah.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pemasukan-sampah-peradmin.pdf');
        } else if ($request->input('tanggalawal') != null && $request->input('tanggalakhir') != null && $request->input('role') === 'petugas' && $request->input('lokasi') === null) {
            // download menurut tanggal dan role petugas
            $request->validate([
                'tanggalawal' => 'nullable|date',
                'tanggalakhir' => 'nullable|date',
            ]);
            $datefrom = $request->input('tanggalawal');
            $dateto = $request->input('tanggalakhir');
            $query = TukarPoint::where('admin_id', Auth::user()->admin->id)
                ->where('status', 'penambahan poin')->whereIn('petugas_id', $request->input('petugas'));
            if ($datefrom && $dateto) {
                $query->whereBetween('tanggal', [$datefrom, $dateto]);
            }
            $laporan = $query->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pemasukan sampah.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pemasukan-sampah-perpetugas.pdf');
        } else if ($request->input('tanggalawal') === null && $request->input('tanggalakhir') === null && $request->input('role') === 'admin' && $request->input('lokasi') === null) {
            // download menurut role admin saja
            $laporan = TukarPoint::where('admin_id', Crypt::decrypt($id))->where('status', 'penambahan poin')->whereNull('petugas_id')->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pemasukan sampah.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pemasukan-sampah-admin.pdf');
        } else if ($request->input('tanggalawal') === null && $request->input('tanggalakhir') === null && $request->input('role') === 'petugas' && $request->input('lokasi') === null) {
            // download menurut role petugas saja
            $request->validate([
                'petugas' => 'required|array',
                'petugas.*' => 'integer'
            ]);
            $adminId = Crypt::decrypt($id);
            $laporan = TukarPoint::where('admin_id', $adminId)
                ->where('status', 'penambahan poin')
                ->whereIn('petugas_id', $request->input('petugas'))
                ->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pemasukan sampah.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pemasukan-sampah-petugas.pdf');
        } else if ($request->input('tanggalawal') != null && $request->input('tanggalakhir') != null && $request->input('role') === Null && $request->input('lokasi') != null) {
            // download menurut tanggal dan lokasi
            $request->validate([
                'tanggalawal' => 'nullable|date',
                'tanggalakhir' => 'nullable|date',
            ]);
            $datefrom = $request->input('tanggalawal');
            $dateto = $request->input('tanggalakhir');
            $query = TukarPoint::where('admin_id', Auth::user()->admin->id)
                ->where('status', 'penambahan poin')
                ->whereIn('lokasi_id', $request->input('lokasi'));
            if ($datefrom && $dateto) {
                $query->whereBetween('tanggal', [$datefrom, $dateto]);
            }
            $laporan = $query->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            // dd($laporan);
            $pdf = Pdf::loadView('admin.laporan.pemasukan sampah.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pemasukan-sampah-perlokasi.pdf');
        } else if ($request->input('tanggalawal') === null && $request->input('tanggalakhir') === null && $request->input('role') === 'petugas' && $request->input('lokasi') != null) {
            // download menurut role petugas dan lokasi
            $request->validate([
                'lokasi' => 'required|array',
                'lokasi.*' => 'integer',
                'petugas' => 'required|array',
                'petugas.*' => 'integer',
            ]);
            $adminId = Crypt::decrypt($id);
            $laporan = TukarPoint::where('admin_id', $adminId)
                ->where('status', 'penambahan poin')
                ->whereIn('petugas_id', $request->input('petugas'))
                ->whereIn('lokasi_id', $request->input('lokasi'))
                ->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pemasukan sampah.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pemasukan-sampah-lokasi-petugas.pdf');
        } else if ($request->input('tanggalawal') != null && $request->input('tanggalakhir') != null && $request->input('role') === 'petugas' && $request->input('lokasi') != null) {
            // download menurut tanggal, role petugas dan lokasi
            // download menurut tanggal dan role petugas
            $request->validate([
                'tanggalawal' => 'nullable|date',
                'tanggalakhir' => 'nullable|date',
                'petugas' => 'required|array',
                'petugas.*' => 'integer',
                'lokasi' => 'required|array',
                'lokasi.*' => 'integer',
            ]);
            $datefrom = $request->input('tanggalawal');
            $dateto = $request->input('tanggalakhir');
            $query = TukarPoint::where('admin_id', Auth::user()->admin->id)
                ->where('status', 'penambahan poin')
                ->whereIn('petugas_id', $request->input('petugas'))
                ->whereIn('lokasi_id', $request->input('lokasi'));
            if ($datefrom && $dateto) {
                $query->whereBetween('tanggal', [$datefrom, $dateto]);
            }
            $laporan = $query->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pemasukan sampah.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pemasukan-sampah-pertanggal-petugas-lokasi.pdf');
        } else if ($request->input('tanggalawal') === null && $request->input('tanggalakhir') === null && $request->input('role') === null && $request->input('lokasi') != null) {
            // download menurut lokasi saja
            $request->validate([
                'lokasi' => 'required|array',
                'lokasi.*' => 'integer'
            ]);
            $adminId = Crypt::decrypt($id);
            $laporan = TukarPoint::where('admin_id', $adminId)
                ->where('status', 'penambahan poin')
                ->whereIn('lokasi_id', $request->input('lokasi'))
                ->get();
            $data['laporan'] = $laporan;
            if ($laporan->isEmpty()) {
                alert()->warning('Warning', 'Data Tidak Ada');
                return redirect()->back();
            }
            $pdf = PDF::loadView('admin.laporan.pemasukan sampah.cetaklaporan', $data);
            $pdf->setPaper('F4', 'landscape');
            return $pdf->stream('Laporan-pemasukan-sampah-lokasi.pdf');
        }
    }
}
