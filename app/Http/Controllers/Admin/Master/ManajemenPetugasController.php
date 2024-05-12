<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\DateTime;

class ManajemenPetugasController extends Controller
{
    public function index()
    {
        $akun = Petugas::where('admin_id', Auth::user()->admin->id)->get();
        $data['akun'] = $akun;
        return view('admin.master.kelola akun petugas.index', $data);
    }
    public function store(Request $request)
    {
        // dd(Auth::user()->admin->id);
        $request->validate([
            // 'username' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Format dan ukuran gambar yang diizinkan
        ]);

        $params1 = $request->all();
        $params2 = [
            'username' => $request->username,
            'password' => Hash::make('123456789'),
            'role' => 'petugas',
            'status' => 'aktif',
        ];
        if ($request->has('image')) {
            $params1['image'] = $this->simpanImage($params2['role'], $request->file('image'), $params1['name']);
        }

        $user = User::create($params2);
        if ($user) {
            $params1['user_id'] = $user->id;
            // $admin = Admin::where('user_id', Auth::user()->id)->first();
            $params1['admin_id'] = Auth::user()->admin->id;
            $petugas = Petugas::create($params1);
            if ($petugas) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                $user->delete();
                alert()->error('Error', 'Data Gagal Disimpan');
            }
        }
        return redirect()->route('Admin.master.akun-petugas.index');
    }
    public function update(Request $request, $id)
    {
        // dd(Crypt::decrypt($id));
        if ($request->password !== $request->password_confirmation) {
            alert()->error('Error', 'konfirmasi password tidak sama dengan password.');
            return redirect()->route('SuperAdmin.master.akun.index');
        }
        $request->validate([
            // 'username' => 'required|string|max:255',
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $params1 = $request->all();
        $params2['username'] = $request->username;
        // Pengecekan jika password konfirmasi tidak sama dengan password

        if ($request->filled('password')) {
            $params2['password'] = Hash::make($request->password);
        } else {
            $params2 = $request->except('password');
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $params1['image'] = $this->simpanImage($params2['role'], $file, $params1['name']);
            } else {
                return redirect()->back()->with('error', 'File foto tidak valid');
            }
        } else {
            $params1 = $request->except('image');
        }
        // $cari = Petugas::where('user_id', Crypt::decrypt($id))->first();
        $petugas = Petugas::findOrFail(Crypt::decrypt($id));
        $user = User::findOrFail($petugas->user_id);
        if ($petugas->update($params1) && $user->update($params2)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }

        return redirect()->route('Admin.master.akun-petugas.index')->with('success', 'Data berhasil diperbarui');
    }
    public function destroy($id)
    {
        // dd('hallo');
        $users = Petugas::findOrFail(Crypt::decrypt($id));
        $url = $users->image;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        // rmdir($dir);
        if ($users->delete()) {
            $user = User::findOrFail($users->user_id);
            $user->delete();
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect()->route('Admin.master.akun-petugas.index');
    }
    public function verifikasistatus($id)
    {
        $params['status'] = 'aktif';
        $petugas = Petugas::where('id', Crypt::decrypt($id))->first();
        $user = User::where('id', $petugas->user->id)->first();
        if ($user->update($params)) {
            alert()->success('Success', $petugas->name . ' Telah di Aktifkan');
        } else {
            alert()->error('Error', $petugas->name . ' Gagal di Aktifkan');
        }
        return redirect()->route('Admin.master.akun-petugas.index');
    }
    public function unverifikasistatus($id)
    {
        $params['status'] = 'tidak aktif';
        $petugas = Petugas::where('id', Crypt::decrypt($id))->first();
        $user = User::where('id', $petugas->user->id)->first();
        if ($user->update($params)) {
            alert()->success('Success', $petugas->name . ' Telah di Nonaktifkan');
        } else {
            alert()->error('Error', $petugas->name . ' Gagal di Nonaktifkan');
        }
        return redirect()->route('Admin.master.akun-petugas.index');
    }
    private function simpanImage($type, $foto, $nama)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/profil/' . $type . '/' . $dt->format('Y-m-d') . '/' . $nama);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $file = $foto;
        $name =  $type . '_' . $nama . '_' . $dt->format('Y-m-d');
        $fileName = $name . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/profil/' . $type . '/' . $dt->format('Y-m-d') . '/' . $nama;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }
}
