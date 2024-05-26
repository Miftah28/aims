<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileAPIController extends Controller
{
    public function profilepetugas()
    {
        $petugas = Petugas::where('id', Auth::user()->petugas->id)->with('user')->first();
        return response()->json([
            'success' => true,
            'data' => [
                'petugas' => $petugas,
                // 'lokasi' => $lokasi
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }
    public function profilenasabah()
    {
        $petugas = Nasabah::where('id', Auth::user()->nasabah->id)->with('user')->first();
        return response()->json([
            'success' => true,
            'data' => [
                'petugas' => $petugas,
                // 'lokasi' => $lokasi
            ],
            'message' => 'Sukses menampilkan data'
        ]);
    }
}
