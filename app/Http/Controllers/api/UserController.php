<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email' => 'El campo email es obligatorio',
            'password' => 'El Campo contraseña es obligatorio'
        ]);
        $user_response = $user->where('email', '=', $request->email)->first();
        if (!is_null($user_response)) {
            if (Hash::check($request->password, $user_response->password)) {
                //$access_token = $request->user()->createToken("auth_token")->plainTextToken;
                $access_token = $user_response->createToken("auth_token")->plainTextToken;
                return response()->json([
                    "status" => true,
                    "message" => "Inicio de sesión exitoso",
                    "access_token" => $access_token,
                    "user" => $user_response
                ], 200);
            } else {
                return response()->json(
                    [
                        "message" => "error, contraseña es incorrecta ",
                        "type" => "password"
                    ],
                    404
                );
            }
        } else {
            return response()->json([
                "message" => "email {$request->email} no existe",
                "type" => "email"
            ], 
                404);
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, User $user)
    {
        $user_data = $request->all();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone' => 'required'
        ], [
            'name' => 'El campo nombre es obligatorio',
            'email' => 'El campo email es obligatorio',
            'password' => 'El Campo contraseña es obligatorio'
        ]);
        $user_data['password'] = Hash::make($request->password);
        $user->create($user_data);
        return response()->json([
            'message' => 'Usuario creado con éxito!',
            'user' => $user_data
        ], 200);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return response()->json([
            'message' => 'Perfíl de usuario---',
            'user' => auth()->user()
        ], 200);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request, User $user)
    {
        $user_response = $user->where('email', '=', $request->email)->first();
        $user_response->tokens()->delete();
        return response()->json(["message" => "Se cerró correctamente la sesión"],200);
    }
}
