<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Sampah;
use App\Models\TukarPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringDataController extends Controller
{
    public function monitoringpemasukansampah()
    {
        $pemasukan = Sampah::where('admin_id', Auth::user()->admin->id)->whereNotNull('petugas_id')->get();
        $data['pemasukan'] = $pemasukan;
        // dd($pemasukan);
        return view('admin.master.monitoring pemasukan sampah.index', $data);
    }
    public function monitoringpengeluaranpoin()
    {
        $pengeluaran = TukarPoint::where('admin_id', Auth::user()->admin->id)->whereNotNull('petugas_id')->where('status', 'tukar poin')->get();
        $data['pengeluaran'] = $pengeluaran;
        // dd($pengeluaran);
        return view('admin.master.monitoring pengeluaran poin.index', $data);
    }
}
