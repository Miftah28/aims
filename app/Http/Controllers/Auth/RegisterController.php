<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
                'confirmed'
            ]
        ]);

        $params1 = $request->all();
        $params2 = [
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'role' => 'admin',
            'status' => 'prosess',
        ];

        $user = User::create($params2);
        if ($user) {
            $params1['user_id'] = $user->id;
            $admin = Admin::create($params1);
            if ($admin) {
                alert()->success('Success', 'Data Berhasil Disimpan');
            } else {
                $user->delete();
                alert()->error('Error', 'Data Gagal Disimpan');
            }
        }
        return redirect()->route('login');
    }
}
