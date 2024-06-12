<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function editprofilepetugas(Request $request)
    {
        $params1 = $request->all();
        $params2['username'] = $request->username;
        $petugas = Petugas::findOrFail(Auth::user()->petugas->id);
        $user = User::findOrFail($petugas->user_id);
        if ($petugas->update($params1) && $user->update($params2)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'petugas' => $petugas,
                    'user' => $user
                ],
                'message' => 'Sukses menampilkan data'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Gagal di tampilkan data',
            ], 500);
        }
    }

    public function editprofilenasabah(Request $request)
    {
        $params1 = $request->all();
        $params2['username'] = $request->username;
        $nasabah = Nasabah::findOrFail(Auth::user()->nasabah->id);
        $user = User::findOrFail($nasabah->user_id);
        if ($nasabah->update($params1) && $user->update($params2)) {
            return response()->json([
                'success' => true,
                'data' => [
                    'nasabah' => $nasabah,
                    'user' => $user
                ],
                'message' => 'Sukses menampilkan data'
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Gagal di tampilkan data',
            ], 500);
        }
    }
}
