<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\TukarPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanPemasukanSampahController extends Controller
{
    public function index()
    {
        $pemasukan = TukarPoint::where('admin_id', Auth::user()->admin->id)->where('status', 'penambahan poin')->get();
        $data['pemasukan'] = $pemasukan;
        return view('admin.laporan.pemasukan sampah.index', $data);
    }
}
