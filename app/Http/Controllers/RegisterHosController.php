<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hospital;

class RegisterHosController extends Controller
{
    public function init()
    {
        $user = Auth::guard('hospitals')->user();

        return response()->json(['hospital' => $user], 200);
    }

    public function registerHospital(Request $request)
    {
        $user = Hospital::where('username', $request->username)->first();

        if(isset($user->id))
        {
            return response()->json(['error' => 'Username already exists.'], 401);
        }
        $user = new Hospital();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();
    }

    public function loginHospital(Request $request)
    {
        if (Auth::guard('hospitals')->attempt(['username' => $request->username, 'password' => $request->password], true))
        {
            return response()->json(Auth::guard('hospitals')->user(),200);
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
