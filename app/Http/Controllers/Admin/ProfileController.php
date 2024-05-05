<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $data['user'] = $user;
        $admin = Admin::where('user_id', $user->id)->first();
        $data['admin'] = $admin;
        // dd($superadmin);
        return view('admin.profile', $data);
    }
    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        // dd($user);
        $superadmin = Admin::where('user_id', auth()->user()->id)->first();

        $superadminParams = $request->only(['name', 'image']);
        if ($request->has('image')) {
            $superadminParams['image'] = $this->simpanImage($superadmin->user->role, $request->file('image'), $superadminParams['name']);
        } else {
            $superadminParams = $request->except('image');
        }
        $superadmin->update($superadminParams);

        $user->update([
            'username' => $request->input('username'),
        ]);

        alert()->success('Success', 'Data Berhasil Disimpan');
        return redirect()->route('Admin.profile.index');
    }

    public function reset(Request $request)
    {
        if ($request->new_password !== $request->password_confirmation) {
            alert()->error('Error', 'konfirmasi password tidak sama dengan password.');
            return redirect()->route('Admin.profile.index');
        }
        $request->validate([
            'current_password' => 'required',
            // Add other validation rules for your input fields
        ]);

        // Validate the request
        // $request->validate($validationRules);
        try {
            $user = User::findOrFail(auth()->user()->id);
            // dd('hello');
            if ($request->filled('current_password')) {

                if (Hash::check($request->current_password, $user->password)) {
                    if (Hash::check($request->new_password, $user->password)) {
                        $months_ago = $user->updated_at->diffInMonths(now());
                        if ($months_ago == 0) {
                            alert()->error('Error', 'Password baru tidak boleh sama dengan password yang diubah bulan ini.');
                            return redirect()->route('Admin.profile.index');
                        } else {
                            alert()->error('Error', 'Password baru tidak boleh sama dengan password yang diubah ' . $months_ago . ' bulan lalu.');
                            return redirect()->route('Admin.profile.index');
                        }
                        alert()->error('Error', 'Password baru tidak boleh sama dengan password yang diubah ' . $months_ago . ' bulan lalu.');
                        return redirect()->route('Admin.profile.index');
                    }
                    $user->password = Hash::make($request->new_password);

                    if ($user->save()) {
                        alert()->success('Success', 'Password berhasil diubah.');
                        return redirect()->route('Admin.profile.index');
                    } else {
                        alert()->error('Error', 'Gagal menyimpan perubahan password.');
                    }
                } else {
                    alert()->error('Error', 'Current password tidak sesuai');
                    return redirect()->route('Admin.profile.index');
                }
            } else {
                alert()->error('Error', 'Masukkan password lama.');
            }

            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error('Error', 'Terjadi kesalahan saat memproses perubahan password.');
            return redirect()->back();
        }
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
