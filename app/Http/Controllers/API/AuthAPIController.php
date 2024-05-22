<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\PoinNasabah;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthAPIController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $input = $request->all();
        $this->validate($request, [
            'username' => ['required', 'string', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (!auth()->attempt(array('username' => $input['username'], 'password' => $input['password']))) {
            $sql = 'Login Gagal';
        } else {
            if (auth()->user()->role == 'petugas') {
                $sql = User::where('id', auth()->user()->id)->with('petugas')->firstOrFail();
                $token = $sql->createToken('auth_token')->plainTextToken;
                $sql->token = $token;
                $sql->token_type = 'Bearer';

                return response()
                    ->json([
                        'success' => true,
                        'message' => 'Hi ' . $sql->name . ', selamat datang di sistem presensi',
                        'data' => $sql
                    ]);
            } elseif (auth()->user()->role == 'nasabah') {
                $sql = User::where('id', auth()->user()->id)->with('nasabah')->firstOrFail();
                $token = $sql->createToken('auth_token')->plainTextToken;
                $sql->token = $token;
                $sql->token_type = 'Bearer';

                return response()
                    ->json([
                        'success' => true,
                        'message' => 'Hi ' . $sql->name . ', selamat datang di sistem presensi',
                        'data' => $sql
                    ]);
            } else {
                $sql = 'Login Gagal';
            }
        }

        // return response()->json($sql);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required|max:20',
            'username' => 'string|required|email|unique:users',
            'alamat' => 'string|required|max:100',
            'no_hp' => 'string|required|max:12',
            'password' => [
                'required',
                'min:8',
                'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/',
                'confirmed'
            ]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $userData = [
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'nasabah',
            'status' => 'aktif',
        ];

        $user = User::create($userData);
        if ($user) {
            $nasabahData = $request->only(['name', 'alamat', 'no_hp']);
            $nasabahData['user_id'] = $user->id;
            $nasabahData['kode_pengguna'] = generateRandomCode(12);
            $nasabah = Nasabah::create($nasabahData);
            $params3 = [
                'nasabah_id' => $nasabah->id,
                'total' => 0,
            ];
            $poin = PoinNasabah::create($params3);
            if ($nasabah && $poin) {
                return response()->json([
                    'success' => true,
                    'data' => $nasabah,
                    'message' => 'Sukses simpan'
                ]);
            } else {
                $user->delete();
                return response()->json([
                    'error' => true,
                    'message' => 'Gagal simpan data nasabah'
                ], 500);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Gagal simpan data pengguna'
            ], 500);
        }
    }
}
