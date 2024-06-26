<?php

namespace App\Http\Controllers\Admin\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\KategoriSampah;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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
            'poin_sampah' => 'required|integer|max:1000000',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Format dan ukuran gambar yang diizinkan
        ]);


        $params1 = $request->all();
        if ($request->has('gambar')) {
            $params1['gambar'] = $this->simpanImage('sampah', $request->file('gambar'), $params1['jenis_sampah']);
        }
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
            'poin_sampah' => 'required|integer|max:1000000',
        ]);

        $params1 = $request->all();
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            if ($file->isValid()) {
                $params1['gambar'] = $this->simpanImage('sampah', $file, $params1['jenis_sampah']);
            } else {
                return redirect()->back()->with('error', 'File foto tidak valid');
            }
        } else {
            $params1 = $request->except('gambar');
        }

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
    private function simpanImage($type, $foto, $nama)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/kategori/' . $type . '/' . $dt->format('Y-m-d') . '/' . $nama);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $file = $foto;
        $name =  $type . '_' . $nama . '_' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/kategori/' . $type . '/' . $dt->format('Y-m-d') . '/' . $nama;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }
}
