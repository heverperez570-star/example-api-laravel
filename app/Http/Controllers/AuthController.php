<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        
        try {
            // Encriptamos la contraseña
            $hashPassword = bcrypt($validatedData['password']);

            $newUser = new User();

            $newUser->role_id = $validatedData['role_id'];
            $newUser->names = $validatedData['names'];
            $newUser->last_names = $validatedData['last_names'];
            $newUser->username = $validatedData['username'];
            $newUser->email = $validatedData['email'];
            $newUser->password = $hashPassword;

            $newUser->save();

            return response()->json([
                'message' => 'Usuario registrado exitosamente.',
                'data' => $newUser,
                'status' => 'success',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al registrar el usuario.',
                'data' => null,
                'status' => 'error',
            ], 500);
        }
    }
    
    public function login(LoginRequest $request)
    {
        // Request para validar los datos que se envían
        $validatedData = $request->validated();

        try {
            
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error al iniciar sesión.',
                'data' => null,
                'status' => 'error',
            ], 500);
        }
    }

    public function profile() {}
    public function logout() {}

    // public function sendResetLink() {}
    // public function resetPassword() {}
}
