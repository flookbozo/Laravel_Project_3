<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterUserController extends Controller
{
    public function init()
    {
        $user = Auth::user();

        return response()->json(['user' => $user], 200);
    }

    public function registerUser(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if(isset($user->id))
        {
            return response()->json(['error' => 'Username already exists.'], 401);
        }
        $user = new User();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();
    }

    public function loginUser(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], true))
        {
            return response()->json(Auth::user(),200);
        }
        else {
            return response()->json(['error' => 'Could not login.'], 401);
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
