<?php

namespace App\Http\Controllers\SuperAdmin\setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Team;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        $team = Team::all();
        $data = [
            'setting' => $setting,
            'team' => $team,
        ];
        return view('super admin.setting.setting', $data);
    }

    public function update(Request $request)
    {
        // Mengambil semua parameter request
        $params = $request->all();

        // Mengambil parameter khusus untuk setting
        // $settingParams = $request->only(['logo', 'nama_aplikasi']);

        // Jika ada file logo yang diupload, simpan dan perbarui parameter setting
        if ($request->hasFile('logo')) {
            $params['logo'] = $this->simpanImage('logo', $request->file('logo'), $request->nama_aplikasi);
        }

        // Ambil data setting yang ada berdasarkan ID
        $setting = Setting::find(1);

        // Perbarui data setting dengan parameter yang relevan
        if ($setting->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }

        // Redirect ke halaman index setting
        return redirect()->route('SuperAdmin.setting.index');
    }

    public function createteam(Request $request)
    {
        $params = $request->all();
        if ($request->hasFile('foto')) {
            $params['foto'] = $this->simpanImage('team', $request->file('foto'), $request->nama);
        }
        if (Team::create($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }

        // Redirect ke halaman index setting
        return redirect()->route('SuperAdmin.setting.index');
    }
    public function updateteam(Request $request, $id)
    {

        $params = $request->all();
        if ($request->hasFile('foto')) {
            $params['foto'] = $this->simpanImage('team', $request->file('foto'), $request->nama);
        }
        $kategori = Team::findOrFail(Crypt::decrypt($id));
        if ($kategori->update($params)) {
            alert()->success('success', 'Data berhasil diperbarui');
        } else {
            alert()->error('Error', 'Data Gagal Diperbarui');
        }
        return redirect()->route('SuperAdmin.setting.index');
    }
    public function destroyteam($id)
    {
        // dd('hallo');
        $team = Team::findOrFail(Crypt::decrypt($id));
        $url = $team->foto;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        // rmdir($dir);
        if ($team->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        } else {
            alert()->error('Error', 'Data Gagal Dihapus');
        }
        return redirect()->route('SuperAdmin.setting.index');
    }

    private function simpanImage($type, $foto, $nama)
    {
        $dt = new DateTime();
        if ($type == 'team') {
            $path = public_path('storage/uploads/' . $type . '/' . $dt->format('Y-m-d') . '/' . $nama);
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true, true);
            }
            $file = $foto;
            $name =  $type . '_' . $nama . '_' . $dt->format('Y-m-d');
            $fileName = $name . '.' . $file->getClientOriginalExtension();
            $folder = '/uploads/' . $type . '/' . $dt->format('Y-m-d') . '/' . $nama;

            $check = public_path($folder) . $fileName;

            if (File::exists($check)) {
                File::delete($check);
            }

            $filePath = $file->storeAs($folder, $fileName, 'public');
            return $filePath;
        } else {
            $path = public_path('storage/uploads/onpige/' . $type . '/' . $nama);
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0755, true, true);
            }
            $file = $foto;
            $name =  $type . '_' . $nama . '_' . $dt->format('Y-m-d');
            $fileName = $name . '.' . $file->getClientOriginalExtension();
            $folder = '/uploads/onpige/' . $type . '/' . $nama;

            $check = public_path($folder) . $fileName;

            if (File::exists($check)) {
                File::delete($check);
            }

            $filePath = $file->storeAs($folder, $fileName, 'public');
            return $filePath;
        }
    }
}
