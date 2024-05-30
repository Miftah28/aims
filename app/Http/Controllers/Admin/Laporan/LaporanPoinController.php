<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\TukarPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanPoinController extends Controller
{
    public function index()
    {
        $pengeluaran = TukarPoint::where('admin_id', Auth::user()->admin->id)->where('status', 'tukar poin')->get();
        $data['pengeluaran'] = $pengeluaran;
        return view('admin.laporan.pengeluran poin.index', $data);
    }
}
