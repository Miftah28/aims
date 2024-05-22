<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    }
}
