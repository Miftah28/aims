<?php

namespace App\Http\Controllers\Admin\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KategoriSampahController extends Controller
{
    public function index()
    {
        $kategori = KategoriSampah::where('admin_id', Auth::user()->admin->id)->get();
        $data['kategori'] = $kategori;
        return view('admin.manajemen sampah.kategori sampah.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'jenis_sampah' => 'required|string|max:25',
            'berat_sampah' => 'required|integer|max:100|min:1',
            'poin_sampah' => 'required|integer|max:1000',
        ]);

        $params1 = $request->all();
        $params1['admin_id'] = Auth::user()->admin->id;
        $kategori = KategoriSampah::create($params1);
        if ($kategori) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect()->route('Admin.manajemen-sampah.ketegori-sampah.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_sampah' => 'required|string|max:25',
            'berat_sampah' => 'required|integer|max:100|min:1',
            'poin_sampah' => 'required|integer|max:1000',
        ]);

        $params1 = $request->all();

        $kategori = KategoriSampah::findOrFail(Crypt::decrypt($id));
        if ($kategori->update($params1)) {
            alert()->success('success', 'Data berhasil diperbarui');
        } else {
            alert()->error('Error', 'Data Gagal Diperbarui');
        }
        return redirect()->route('Admin.manajemen-sampah.ketegori-sampah.index');
    }
    public function destroy($id)
    {
        // dd('hallo');
        $kategori = KategoriSampah::findOrFail(Crypt::decrypt($id));

        if ($kategori->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        } else {
            alert()->error('Error', 'Data Gagal Dihapus');
        }
        return redirect()->route('Admin.manajemen-sampah.ketegori-sampah.index');
    }
}
