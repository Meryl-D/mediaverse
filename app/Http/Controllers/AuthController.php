<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials, true)) {

            return response([
                'error' => 'Identifiants incorrects'
            ], 422);
        }

        $user = Auth::user();

        $roleId = $user['role_id'];
        $role = Role::where('id', $roleId)->value('name');

        $token = $user->createToken('utiliz_token')->plainTextToken;

        $response = [
            'firstName' => $user['first_name'],
            'lastName' => $user['last_name'],
            'role' => $role,
            'token' => $token
        ];
        
        return response()->json($response);
    }

    public function logout()
    {
        try {
            Auth::user()->currentAccessToken()->delete();
            $success = true;
            $message = 'Déconnexion réussie';
        } catch (QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}
