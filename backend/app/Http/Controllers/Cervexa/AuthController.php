<?php

namespace App\Http\Controllers\Cervexa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Dummy authentication for Cervexa
        if ($email && $password) {
            return response()->json([
                'token' => 'cervexa_dummy_token_' . time(),
                'user' => [
                    'id' => 1,
                    'name' => 'Dokter Cervexa',
                    'email' => $email,
                    'role' => 'doctor',
                    'hospital_name' => 'Klinik KMed'
                ]
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
    {
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function me(Request $request)
    {
        return response()->json([
            'id' => 1,
            'name' => 'Dokter Cervexa',
            'email' => 'doctor@cervexa.com',
            'role' => 'doctor',
            'hospital_name' => 'Klinik KMed'
        ]);
    }
}
