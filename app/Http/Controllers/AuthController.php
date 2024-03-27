<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;

class AuthController extends Controller
{
  /**
   * Create user
   *
   * @param  [string] name
   * @param  [string] email
   * @param  [string] password
   * @param  [string] password_confirmation
   * @return [string] message
   */
  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'email' => 'required|string|email|unique:users',
      'password' => 'required|string|',
      'c_password' => 'required|same:password',
    ]);

    $user = new User([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password)
    ]);
    if ($user->save()) {
      return response()->json([
        'message' => 'Successfully created user!'
      ], 201);
    } else {
      return response()->json(['error' => 'Provide proper details']);
    }
  }

  /**
   * Login user and create token
   *
   * @param  [string] email
   * @param  [string] password
   * @param  [boolean] remember_me
   * @return [string] access_token
   * @return [string] token_type
   * @return [string] expires_at
   */
  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
      'remember_me' => 'boolean'
    ]);
    $credentials = request(['email', 'password']);
    if (!Auth::attempt($credentials))
      return response()->json([
        'message' => 'Unauthorized'
      ], 401);
    $user = $request->user();
    // $user['role'] = 'admin';
    $user['image'] = '/vuexy-vuejs-admin-template/demo-1/images/avatars/avatar-1.png';
    $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;
    $user['accessToken'] = $token;

    return response()->json($user);


    //   {
    //     "userAbilityRules": [
    //         {
    //             "action": "manage",
    //             "subject": "all"
    //         }
    //     ],
    //     "accessToken": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6Mn0.cat2xMrZLn0FwicdGtZNzL7ifDTAKWB0k1RurSWjdnw",
    //     "userData": {
    //         "id": 1,
    //         "fullName": "John Doe",
    //         "username": "johndoe",
    //         "avatar": "/vuexy-vuejs-admin-template/demo-1/images/avatars/avatar-1.png",
    //         "email": "admin@demo.com",
    //         "role": "admin"
    //     }
    // }

  }

  /**
   * Get the authenticated User
   *
   * @return [json] user object
   */
  public function user(Request $request)
  {
    return response()->json($request->user());
  }

  /**
   * Logout user (Revoke the token)
   *
   * @return [string] message
   */
  public function logout(Request $request)
  {
    $request->user()->token()->revoke();
    return response()->json([
      'message' => 'Successfully logged out'
    ]);
  }
}
