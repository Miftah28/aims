<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $credentials = [
            'username' => $input['username'],
            'password' => $input['password'],
        ];

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            if ($user->status === 'aktif') {
                if (auth()->user()->role == 'superadmin') {
                    if ($input['password'] === '123456789') {
                        alert()->warning('Warning', 'Anda harus mengubah password terlebih dahulu.');
                        return redirect()->route('SuperAdmin.profile.index'); // Ganti dengan nama route untuk mengubah password
                    } else {
                        alert()->toast('Welcome <b>' . $user->superadmin->name . '</b>, you have been successfully logged in!', 'success')->position('top-end');
                        return redirect()->route('home');
                    }
                } else if (auth()->user()->role == 'admin') {
                    if ($input['password'] === '123456789') {
                        alert()->warning('Warning', 'Anda harus mengubah password terlebih dahulu.');
                        return redirect()->route('Admin.profile.index'); // Ganti dengan nama route untuk mengubah password
                    } else {
                        alert()->toast('Welcome <b>' . $user->admin->name . '</b>, you have been successfully logged in!', 'success')->position('top-end');
                        return redirect()->route('home')->with('success', 'success');
                    }
                }
            } elseif ($user->status === 'tidak aktif') {
                auth()->logout(); // Log out the user
                alert()->toast('Akun Anda sudah Tidak Aktif, Silakan Hubungi Pihak Admin', 'error')->position('top-end');
                return redirect()->route('login');
            } elseif ($user->status === 'prosess') {
                auth()->logout(); // Log out the user
                alert()->toast('Akun Anda Belum DiValidasi oleh Admin, Silakan Hubungi Pihak Admin', 'error')->position('top-end');
                return redirect()->route('login');
            } elseif ($user->status === 'tidak diterima') {
                auth()->logout(); // Log out the user
                $admin = Admin::where('user_id', $user->id)->first();
                alert()->toast('Akun Anda Tidak Diterima oleh admin, Karena ' . $admin->keterangan, 'error')->position('top-end');
                return redirect()->route('login');
            }
        } else {
            // Cek apakah username ada dalam database
            $user = User::where('username', $input['username'])->first();
            if ($user) {
                alert()->toast('Username/Email dan Password anda salah', 'error')->position('top-end');
            } else {
                alert()->toast('Akun Anda Tidak Ditemukan, Silakan Anda Daftar Dahulu', 'error')->position('top-end');
            }
            return redirect()->route('login');
        }
    }
}
