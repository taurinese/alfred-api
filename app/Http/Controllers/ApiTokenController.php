<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiTokenController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->tokens()->where('tokenable_id', $user->id)->delete();

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'token' => $token,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'status' => Status::find($user->status_id)->name
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'status_id' => 'exists:statuses,id'
        ]);

/*         $exists = User::where('email', $request->email)->exists();

        if ($exists) {
            return response()->json(['error' => 'You are already registered. Please login instead.']);
        } */

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_id' => $request->status_id,
            'email_verified' => false
        ]);

        $request->merge(['user' => $user]);

        $request->setUserResolver(function () use ($user) {
            return $user;
        });
        // dd($request->user());

        $user = User::find($user->id);
        // dd($user);
        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([   
            'token' => $token,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'status' => Status::find($user->status_id)->name
        ]);
    }
    
}
