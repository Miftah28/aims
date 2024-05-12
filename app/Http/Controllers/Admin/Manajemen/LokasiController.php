<?php

namespace App\Http\Controllers\Admin\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LokasiController extends Controller
{
    public function index()
    {
        $tempat = Lokasi::where('admin_id', Auth::user()->admin->id)->get();
        $data['tempat'] = $tempat;
        return view('admin.manajemen sampah.kelola tempat penjemputan.index', $data);
    }
    public function create()
    {
        return view('admin.manajemen sampah.kelola tempat penjemputan.create');
    }
    public function edit($id)
    {
        $tempat = Lokasi::where('id', Crypt::decrypt($id))->first();
        // dd($tempat);
        $data['tempat'] = $tempat;
        return view('admin.manajemen sampah.kelola tempat penjemputan.edit', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'tempat' => 'required|string|max:255',
            'koordinat' => 'required|string|max:255',
        ]);
        $params = $request->all();
        $params['admin_id'] = Auth::user()->admin->id;
        $tempat = Lokasi::create($params);
        if ($tempat) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect()->route('Admin.manajemen-sampah.kelola-tempat.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'tempat' => 'required|string|max:255',
            'koordinat' => 'required|string|max:255',
        ]);
        $params = $request->all();
        $tempat = Lokasi::findOrFail(Crypt::decrypt($id));
        if ($tempat->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect()->route('Admin.manajemen-sampah.kelola-tempat.index');
    }
    public function destroy($id)
    {
        $tempat = Lokasi::findOrFail(Crypt::decrypt($id));
        if ($tempat->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        } else {
            alert()->error('Error', 'Data Gagal Dihapus');
        }
        return redirect()->route('Admin.manajemen-sampah.kelola-tempat.index');
    }
}
