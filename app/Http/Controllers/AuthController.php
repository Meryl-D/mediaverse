<?php

namespace App\Http\Controllers;

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

        if (Auth::attempt($credentials, true)) {
            $success = true;
            $message = 'Connexion réussie';
            $user = Auth::user();
            $token = $user->createToken('utiliz_token')->plainTextToken;
        } else {
            $success = false;
            $message = 'Accès non authorisé';
            $user = null;
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
            'id' => $user['id'],
            'firstName' => $user['first_name'],
            'lastName' => $user['last_name'],
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
