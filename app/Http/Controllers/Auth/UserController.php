<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createExampleUser() {
        $user = User::where('email', 'email@example.com')->first();
        if (!$user) {
            User::create([
                'name' => 'User',
                'email' => 'email@example.com',
                'password' => 'password'
            ]);
        }
        return 'Usuario Creado';
    }

    public function login(Request $request) {
        $user = User::where('email', $request->input('email'))->first();
    
        if (!$user) {
            return response()->json([
                'message'=>'Not user'
            ], 400);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message'=>'Password error'
            ], 401);
        }
    
        return response()->json([
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ],
            'token' => $user->createToken('api')->plainTextToken,
        ]);
    }
}
