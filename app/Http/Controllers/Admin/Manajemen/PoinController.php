<?php

namespace App\Http\Controllers\Admin\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PoinController extends Controller
{
    public function index()
    {
        $poin = Point::where('admin_id', Auth::user()->admin->id)->get();
        $kategori = KategoriSampah::where('admin_id', Auth::user()->admin->id)->get();
        $data = [
            'poin' => $poin,
            'kategori' => $kategori,
        ];
        return view('admin/manajemen sampah/kelola poin/index', $data);
    }
    public function store(Request $request)
    {

        $request->validate(
            [
                'jumlah_poin'  => 'required|integer|max:10000000',
                // 'jumlah_saldo'  => 'required|double|max:10000000',
            ]
        );
        $params = $request->all();
        // dd($request->all());
        $saldo = $params['jumlah_saldo'];

        // Menghapus simbol 'Rp.', spasi, dan titik pemisah ribuan
        $saldo = str_replace(['Rp', '.', ' '], '', $saldo);

        // Mengonversi string yang telah dibersihkan menjadi double
        $params['jumlah_saldo'] = (float) $saldo;

        $params['admin_id'] = Auth::user()->admin->id;
        $poin = Point::create($params);
        if ($poin) {
            alert()->success('Succes', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect()->route('Admin.manajemen-sampah.kelola-poin.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_poin'  => 'required|integer|max:10000000',
            // 'jumlah_saldo'  => 'required|integer|max:10000000',
        ]);
        // dd($request->all());
        $params = $request->all();
        $poin = Point::findOrFail(Crypt::decrypt($id));
        $saldo = $params['jumlah_saldo'];

        // Menghapus simbol 'Rp.', spasi, dan titik pemisah ribuan
        $saldo = str_replace(['Rp', '.', ' '], '', $saldo);

        // Mengonversi string yang telah dibersihkan menjadi double
        $params['jumlah_saldo'] = (float) $saldo;
        if ($poin->update($params)) {
            alert()->success('Success', 'Data Berhasil Diubah');
        } else {
            alert()->error('Error', 'Data Gagal Diubah');
        }
        return redirect()->route('Admin.manajemen-sampah.kelola-poin.index');
    }
    public function destroy($id)
    {
        $poin = Point::findOrFail(Crypt::decrypt($id));
        if ($poin->delete()) {
            alert()->success('Successs', 'Data Berhasil Dihapus');
        } else {
            alert()->error('Error', 'Data Gagal Dihapus');
        }
        return redirect()->route('Admin.manajemen-sampah.kelola-poin.index');
    }
}
