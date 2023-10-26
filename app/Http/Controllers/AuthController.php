<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->token = $token;
        $user->token_type = 'Bearer';

        return response()
            ->json([
                'success' => true,
                'message' => 'Hi ' . $user->name . ', selamat datang di sistem presensi',
                'data' => $user
            ]);
    }

    public function getUser()
    {
        $user = Auth::user();

        return response()
            ->json([
                'success' => true,
                'message' => 'Data User sudah berhasil dipanggil',
                'data' => $user
            ]);
    }

    public function logOut() {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
    
}
