<?php

namespace App\Http\Controllers\SuperAdmin\setting;

use App\Http\Controllers\Controller;
use App\Models\KotakSaran;
use Illuminate\Http\Request;

class KotakSaranController extends Controller
{
    public function index()
    {
        $saran = KotakSaran::all();
        $data = [
            'saran' => $saran,
        ];
        return view('super admin.kotak saran.index', $data);
    }
    public function kirim(Request $request)
    {
        // dd([
        //     'nama' => $request->nama,
        //     'saran' => $request->saran,
        //     'email' => $request->email,
        // ]);
        $params = $request->all();
        $saran = KotakSaran::create($params);
        if ($saran) {
            alert()->success('Success', 'Terimakasi Atas Saran Anda');
        } else {
            alert()->error('Error', 'Saran Gagal Dikirim');
        }

        // Redirect ke halaman index setting
        return redirect()->back();
    }
}
