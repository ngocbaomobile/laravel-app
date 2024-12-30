<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {
      // validate input required, string
        $request ->validate([
          'user_name' => 'required|string',
          'password' => 'required|string'
      ]);
      // check credentials
      $credentials = $request->only('user_name', 'password');
      if (!$token = JWTAuth::attempt($credentials)) {
          return response()->json(['message' => 'invalid_credentials'], 401);
      }
      return response()->json([
       'token' => $token,
       'message' => 'Successfully logged in'
    ]);
    }

    // implemnt function logout here
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Logout successful']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Logout failed'], 500);
        }
    }
}
