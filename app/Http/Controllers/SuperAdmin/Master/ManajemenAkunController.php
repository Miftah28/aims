<?php

namespace App\Http\Controllers\SuperAdmin\Master;

use App\Http\Controllers\Controller;
use App\Mail\TolakVerifikasiAkun;
use App\Mail\VerifikasiAkun;
use App\Models\Admin;
use App\Models\Nasabah;
use App\Models\Petugas;
use App\Models\PoinNasabah;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\DateTime;

class ManajemenAkunController extends Controller
{
    // Super admin dan admin
    public function index()
    {
        $akun = User::where('role', '!=', 'petugas')->where('role', '!=', 'nasabah')->get();
        $data['akun'] = $akun;
        return view('super admin.master.akun.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Format dan ukuran gambar yang diizinkan
        ]);
        // dd($request->file('image'));
        $params1 = $request->all();
        $params2 = [
            'username' => $request->username,
            'password' => Hash::make('123456789'),
            'role' => $request->role,
            'status' => $request->status,
        ];

        if ($request->has('image')) {
            $params1['image'] = $this->simpanImage($params2['role'], $request->file('image'), $params1['name']);
        }

        $user = User::create($params2);
        if ($user) {
            if ($params2['role'] == 'superadmin') {
                $params1['user_id'] = $user->id;
                $superadmin = SuperAdmin::create($params1);
                if ($superadmin) {
                    alert()->success('Success', 'Data Berhasil Disimpan');
                } else {
                    $user->delete();
                    alert()->error('Error', 'Data Gagal Disimpan');
                }
            } else if ($params2['role'] == 'admin') {
                $params1['user_id'] = $user->id;
                $admin = Admin::create($params1);
                if ($admin) {
                    alert()->success('Success', 'Data Berhasil Disimpan');
                } else {
                    $user->delete();
                    alert()->error('Error', 'Data Gagal Disimpan');
                }
            }
        }

        return redirect()->route('SuperAdmin.master.akun.index');
    }
    public function update(Request $request, $id)
    {
        // dd(SuperAdmin::where('user_id', Crypt::decrypt($id))->first());
        if ($request->password !== $request->password_confirmation) {
            alert()->error('Error', 'konfirmasi password tidak sama dengan password.');
            return redirect()->route('SuperAdmin.master.akun.index');
        }
        $request->validate([
            'username' => 'required|string|max:255',
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
                $params1['image'] = $this->simpanImage($params2['role'], $file, $params2['username']);
            } else {
                return redirect()->back()->with('error', 'File foto tidak valid');
            }
        } else {
            $params1 = $request->except('image');
        }
        if ($params1['role'] == 'admin') {
            $admin = Admin::where('user_id', Crypt::decrypt($id))->first();
            $petugas = Admin::findOrFail($admin->id);
            $user = User::findOrFail($petugas->user_id);
            if ($petugas->update($params1) && $user->update($params2)) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                alert()->error('Error', 'Data Gagal Disimpan');
            }

            return redirect()->route('SuperAdmin.master.akun.index')->with('success', 'Data berhasil diperbarui');
        } else if ($params1['role'] == 'superadmin') {
            $superadmin = SuperAdmin::where('user_id', Crypt::decrypt($id))->first();
            $petugas = SuperAdmin::findOrFail($superadmin->id);
            $user = User::findOrFail($petugas->user_id);
            if ($petugas->update($params1) && $user->update($params2)) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                alert()->error('Error', 'Data Gagal Disimpan');
            }

            return redirect()->route('SuperAdmin.master.akun.index')->with('success', 'Data berhasil diperbarui');
        }
    }
    public function destroy($id) // delete super admin dan admin
    {
        try {
            $user = User::findOrFail(Crypt::decrypt($id));

            if ($user->role == 'superadmin') {
                $superadmin = SuperAdmin::where('user_id', $user->id)->first();
                $url = $superadmin->image;
            } elseif ($user->role == 'admin') {
                $admin = Admin::where('user_id', $user->id)->first();
                $url = $admin->image;
            } else {
                throw new \Exception('Invalid user role');
            }

            $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
            $path = public_path('storage/' . $url);

            if (File::exists($path)) {
                File::delete($path);
            }

            if (isset($superadmin)) {
                if ($superadmin->delete()) {
                    $user->delete();
                    alert()->success('Success', 'Data Berhasil Dihapus');
                }
            } elseif (isset($admin)) {
                $petugas = Petugas::where('admin_id', $admin->id)->get();

                foreach ($petugas as $subpetugas) {
                    $url = $subpetugas->image;
                    $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
                    $path = public_path('storage/' . $url);

                    if (File::exists($path)) {
                        File::delete($path);
                    }

                    $subpetugas->delete();
                    User::where('id', $subpetugas->user_id)->delete();
                }

                if ($admin->delete()) {
                    $user->delete();
                }
            }
            alert()->success('Success', 'Data Berhasil Dihapus');
            return redirect()->route('SuperAdmin.master.akun.index');
        } catch (\Exception $e) {
            // Handle exceptions
            return back()->withErrors([$e->getMessage()]);
        }
    }
    // petugas
    public function storepetugas(Request $request, $id)
    {
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
            $admin = Admin::where('user_id', Crypt::decrypt($id))->first();
            $params1['admin_id'] = $admin->id;
            $admin = Petugas::create($params1);
            if ($admin) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                $user->delete();
                alert()->error('Error', 'Data Gagal Disimpan');
            }
        }
        return redirect()->route('SuperAdmin.master.akun.index');
    }

    public function updatepetugas(Request $request, $id)
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

        return redirect()->route('SuperAdmin.master.akun.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroypetugas($id)
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
        return redirect()->route('SuperAdmin.master.akun.index');
    }
    // verifikasi dan unverifikasi super admin, admin dan petugas
    public function unverifikasistatus($id)
    {
        $user = User::where('id', Crypt::decrypt($id))->first();
        $params['status'] = 'tidak aktif';
        $superadmin = SuperAdmin::where('user_id', Crypt::decrypt($id))->first();
        $admin = Admin::where('user_id', Crypt::decrypt($id))->first();
        $petugas = Petugas::where('user_id', Crypt::decrypt($id))->first();
        if ($user->role === 'superadmin') {
            // dd($superadmin);
            if ($user->update($params)) {
                alert()->success('Success', $superadmin->name . ' Telah di Nonaktifkan');
            } else {
                alert()->error('Error', $superadmin->name . ' Gagal di Nonaktifkan');
            }
            return redirect()->route('SuperAdmin.master.akun.index');
        } else if ($user->role === 'admin') {
            // dd($admin);
            $caripetugas = Petugas::where('admin_id', $admin->id)->get();
            if ($user->update($params)) {
                // Perbarui sublokus
                foreach ($caripetugas as $caripetugass) {
                    $cariuserpetugas = User::where('id', $caripetugass->user_id)->first();
                    $cariuserpetugas->update($params);
                }
                alert()->success('Success', 'Instansi ' . $admin->instansi . ' Telah di Nonaktifkan');
            } else {
                alert()->error('Error', 'Instansi' . $admin->instansi . ' Telah di Nonaktifkan');
            }
            return redirect()->route('SuperAdmin.master.akun.index');
            // dd($caripetugas);
        } else if ($user->role === 'petugas') {
            // dd($petugas);
            if ($user->update($params)) {
                alert()->success('Success', $petugas->name . ' Telah di Nonaktifkan');
            } else {
                alert()->error('Error', $petugas->name . ' Gagal di Nonaktifkan');
            }
            return redirect()->route('SuperAdmin.master.akun.index');
        }
    }
    public function verifikasistatus($id)
    {
        $user = User::where('id', Crypt::decrypt($id))->first();
        $params['status'] = 'aktif';
        $superadmin = SuperAdmin::where('user_id', Crypt::decrypt($id))->first();
        $admin = Admin::where('user_id', Crypt::decrypt($id))->first();
        $petugas = Petugas::where('user_id', Crypt::decrypt($id))->first();
        if ($user->role === 'superadmin') {
            // dd($superadmin);
            if ($user->update($params)) {
                alert()->success('Success', $superadmin->name . ' Telah di Aktifkan');
            } else {
                alert()->error('Error', $superadmin->name . ' Gagal di Aktifkan');
            }
            return redirect()->route('SuperAdmin.master.akun.index');
        } else if ($user->role === 'admin') {
            // dd($admin);
            $caripetugas = Petugas::where('admin_id', $admin->id)->get();
            if ($user->update($params)) {
                // Perbarui sublokus
                foreach ($caripetugas as $caripetugass) {
                    $cariuserpetugas = User::where('id', $caripetugass->user_id)->first();
                    $cariuserpetugas->update($params);
                }
                alert()->success('Success', 'Instansi ' . $admin->instansi . ' Telah di Aktifkan');
            } else {
                alert()->error('Error', 'Instansi' . $admin->instansi . ' Telah di Aktifkan');
            }
            return redirect()->route('SuperAdmin.master.akun.index');
            // dd($caripetugas);
        } else if ($user->role === 'petugas') {
            // dd($petugas);
            if ($user->update($params)) {
                alert()->success('Success', $petugas->name . ' Telah di Aktifkan');
            } else {
                alert()->error('Error', $petugas->name . ' Gagal di Aktifkan');
            }
            return redirect()->route('SuperAdmin.master.akun.index');
        }
    }
    // 
    public function indexnasabah()
    {
        $akun = Nasabah::all();
        $data['akun'] = $akun;
        return view('super admin.master.akun nasabah.index', $data);
    }

    public function storenasabah(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $params1 = $request->all();
        $params2 = [
            'username' => $request->username,
            'password' => Hash::make('123456789'),
            'role' => 'nasabah',
            'status' => 'aktif',
        ];
        $user = User::create($params2);
        if ($user) {
            $params1['user_id'] = $user->id;
            $params1['kode_pengguna'] = generateRandomCode(12);
            $nasabah = Nasabah::create($params1);
            $params3 = [
                'nasabah_id' => $nasabah->id,
                'total' => 0,
            ];
            $poin = PoinNasabah::create($params3);
            if ($nasabah && $poin) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                $user->delete();
                alert()->error('Error', 'Data Gagal Disimpan');
            }
        }

        return redirect()->route('SuperAdmin.master.akun-nasabah.index-nasabah');
    }
    public function updatenasabah(Request $request, $id)
    {
        // dd(Crypt::decrypt($id));
        if ($request->password !== $request->password_confirmation) {
            alert()->error('Error', 'konfirmasi password tidak sama dengan password.');
            return redirect()->route('SuperAdmin.master.akun-nasabah.index-nasabah');
        }
        $request->validate([
            // 'username' => 'required|string|max:255',
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $params1 = $request->all();
        $params2['username'] = $request->username;
        // Pengecekan jika password konfirmasi tidak sama dengan password

        if ($request->filled('password')) {
            $params2['password'] = Hash::make($request->password);
        } else {
            $params2 = $request->except('password');
        }

        $nasabah = Nasabah::findOrFail(Crypt::decrypt($id));
        $user = User::findOrFail($nasabah->user_id);
        if ($nasabah->update($params1) && $user->update($params2)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }

        return redirect()->route('SuperAdmin.master.akun-nasabah.index-nasabah')->with('success', 'Data berhasil diperbarui');
    }
    public function destroynasabah($id)
    {
        $nasabah = Nasabah::findOrFail(Crypt::decrypt($id));

        if ($nasabah->delete()) {
            $user = User::findOrFail($nasabah->user_id);
            $user->delete();
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect()->route('SuperAdmin.master.akun-nasabah.index-nasabah');
    }
    public function konfirmasiindex()
    {
        $admin = User::where('role', 'admin')->where('status', 'prosess')->get();
        $data['admin'] = $admin;
        return view('super admin.konfirmasi akun.index', $data);
    }
    public function konfirmasi(Request $request, $id)
    {
        // dd($request['keterangan']);
        $params1 = $request->all();
        $params1['status'] = 'aktif';
        $params1['keterangan'] = $request['keterangan'];
        $admin = User::where('id', Crypt::decrypt($id))->first();
        // $keterangan = $request['keterangan'];
        if (!$admin) {
            alert()->error('Error', 'Data Gagal Ditemukan');
            return redirect()->route('SuperAdmin.konfirmasi-akun.index');
        }
        $admin->update($params1);
        Mail::to($admin->username)->send(new VerifikasiAkun());
        alert()->success('Success', 'Data Berhasil Disimpan');

        return redirect()->route('SuperAdmin.konfirmasi-akun.index');
    }
    public function konfirmasitolak(Request $request, $id)
    {
        // dd('tolak');
        // dd($request['keterangan']);
        $params1 = $request->all();
        $params2['status'] = 'tidak diterima';
        $params1['keterangan'] = $request->keterangan;
        $user = User::where('id', Crypt::decrypt($id))->first();
        $admin = Admin::where('user_id', Crypt::decrypt($id))->first();
        $keterangan = $request['keterangan'];
        if (!$user) {
            alert()->error('Error', 'Data Gagal Ditemukan');
            return redirect()->route('SuperAdmin.konfirmasi-akun.index');
        }
        $user->update($params2);
        $admin->update($params1);
        Mail::to($user->username)->send(new TolakVerifikasiAkun($keterangan));
        alert()->success('Success', 'Data Berhasil Disimpan');

        return redirect()->route('SuperAdmin.konfirmasi-akun.index');
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
