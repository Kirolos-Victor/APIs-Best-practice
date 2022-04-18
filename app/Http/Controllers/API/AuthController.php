<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateTimezoneRequest;
use App\Models\User;
use App\Models\UserList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return responseJson(200, 'success', [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return responseJson(200, 'success', [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function updateTimezone(UpdateTimezoneRequest $request)
    {
        $user = Auth::user();
        $user->update([
            'timezone' => $request->timezone
        ]);

        return responseJson(200, 'timezone updated successfully', $user);
    }


}
