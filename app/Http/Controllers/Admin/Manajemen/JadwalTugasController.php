<?php

namespace App\Http\Controllers\Admin\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\JadwalTugas;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
    public function store(Request $request)
    {
        $params = $request->all();
        $params['admin_id'] = Auth::user()->admin->id;
        $jadwal = JadwalTugas::create($params);
        if ($jadwal) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->success('Success', 'Data Gagal Disimpan');
        }
        return redirect()->route('Admin.manajemen-sampah.kelola-jadwal.index');
    }
    public function update(Request $request, $id)
    {
        $params = $request->all();
        $jadwal = JadwalTugas::findOrFail(Crypt::decrypt($id));
        if ($jadwal->update($params)) {
            alert()->success('Success', 'Data Berhasil Diubah');
        } else {
            alert()->error('Error', 'Data Gagal Diubah');
        }
        return redirect()->route('Admin.manajemen-sampah.kelola-jadwal.index');
    }
    public function destroy($id)
    {
        $jadwal = JadwalTugas::findOrFail(Crypt::decrypt($id));
        if ($jadwal->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        } else {
            alert()->error('Error', 'Data Gagal Dihapus');
        }
        return redirect()->route('Admin.manajemen-sampah.kelola-jadwal.index');
    }
}
