<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->role_name = $user->roles[0]->name;
        $user->permissions = (new PermissionService)->getPermissions($user);
        $user->tokens()->delete();

        //need to send response using resource and not provide array or roles.
        return response()->json(['user' => [
            'auth_user' => $user,
            'access_token' => $user->createToken('access_token')->plainTextToken
        ], 'message' => 'Logged in successfully'], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['data' => [], 'message' => 'Logged out Successfully'], Response::HTTP_OK);
    }
}