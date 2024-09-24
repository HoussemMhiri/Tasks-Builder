<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', Password::min(3)->max(20)->mixedCase()->symbols()->numbers()],
            'avatar' => ['nullable']
        ]);

        $credentials = $request->only([
            'name',
            'email',
            'password'
        ]);

        $user = User::create($credentials);

        Mail::to($user->email)->queue(new WelcomeEmail($user));

        return response()->json([
            'user' => $user,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', Rule::exists('users', 'email')],
            'password' => ['required', function ($fail) use ($request) {
                if ($request->email) {
                    $user = User::where('email', $request->email)->first();

                    if (!$user || $request->password !== $user->decrypted_password) {
                        $fail('Invalid Credentials');
                    }
                }
            }],
        ]);


        $user = User::where('email', $request->email)->first();

        $token = $user->createToken($user->name . '_Token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }


    public function logout()
    {

        Auth::user()->tokens()->delete();

        return response()->json('Logout Successfully', 204);
    }


    public function fetch()
    {

        $user = auth()->user();


        return response()->json([
            'user' => $user
        ], 200);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['sometimes', 'required', 'min:8'],
            'avatar' => ['nullable']
        ]);

        $userUpdate = $request->only([
            'name',
            'email',
            'password',
            'avatar'
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $userUpdate['avatar'] = Storage::url($avatarPath);
        }

        $user->update($userUpdate);

        return response()->json([
            'data' => $user
        ], 201);
    }
}
