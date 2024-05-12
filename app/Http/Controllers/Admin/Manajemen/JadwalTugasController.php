<?php

namespace App\Http\Controllers\Admin\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\JadwalTugas;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalTugasController extends Controller
{
    public function index()
    {
        $jadwal = JadwalTugas::where('admin_id', Auth::user()->admin->id)->get();
        $lokasi = Lokasi::where('admin_id', Auth::user()->admin->id)->get();
        $data =
            [
                'jadwal' => $jadwal,
                'lokasi' => $lokasi,
            ];
        return view('admin.manajemen sampah.kelola jadwal penjemputan.index', $data);
    }
}
