<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                'token' => $token,
                'admin' => $user->role->name,
            ], 201);
    }

    public function login(Request $request)
    {
        // $request->validate([
        //     'email'    => 'required|string|email',
        //     'password' => 'required|string',
        // ]);

        // $user = User::where('email', $request->email)->first();

        // if (! $user || ! Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages([
        //         'email' => ['The provided credentials are incorrect.'],
        //     ]);
        // }

        // $token = $user->createToken('auth_token')->plainTextToken;

        // return response()->json(
        //     [
        //         'token' => $token,
        //         'admin' => $user->role->name == 'Admin' ? true : false,
        //     ], 201);
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();

            return response()->json([
                'message' => 'Logged in successfully',

            ]);
        }
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function logout(Request $request)
    {
        // $request->user()->tokens()->delete();
        Auth::logout();
        return response()->json(['message' => 'Logged out']);
    }
}
