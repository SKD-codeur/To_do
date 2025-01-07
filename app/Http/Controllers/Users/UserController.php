<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function login(Request $request) {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|string',
                'password' => 'required'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

       if(Auth::attempt($request->only(['email','password']))) {
            $user = $request->user();
            $token = $user->createToken('My_Token_Name',['*'], now()->addMinute(10))->plainTextToken;

        return response()->json([
            'data' => [
              'infos_user' => $user,
              'token' => $token
            ],
            'message' => 'Authentification reuissie !'
        ]);
       }

       else {
        return response()->json([
            'message' => "Login ou mot de passe incorrecte"
        ]);
       }

    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->save();
        $token = $user->createToken('My_Token_Name', ['*'], now()->addMinute(2))->plainTextToken;

        return response()->json([
            'message' => 'Inscription réuissie',
            'token' => $token,

        ], 201);
    }

    public function logout(Request $request){
            $user = $request->user();

            if ($user) {
                $user->currentAccessToken()->delete();

                return response()->json([
                    'message' => 'Déconnexion réussie'
                ]);
            }
            return response()->json([
                'message' => 'Utilisateur non authentifié'
            ], 401);
    }

    public function listUser(){

        $users = User::all();
        return response()->json([
            'message' => $users
        ]);

    }


}
