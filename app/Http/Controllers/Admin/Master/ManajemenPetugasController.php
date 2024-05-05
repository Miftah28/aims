<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenPetugasController extends Controller
{
    public function index()
    {
        $akun = Petugas::where('admin_id', Auth::user()->id)->get();
        $data['akun'] = $akun;
        return view('admin.master.kelola akun petugas.index', $data);
    }
}
