<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $request->validated();
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|numeric|unique:users,phone|min:10',
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required|string'
            ]
        );

        $acceptedRoles = ['merchant', 'user'];

        if (!in_array($request->role, $acceptedRoles)) {
            return redirect()->back()->withInput()->with(['status' => 'error', 'message' => 'Geçersiz rol!', 'error' => 'Rol sadece "Influencer" veya "Marka" olabilir!']);
        }

        if ($request->role == 'merchant') {
            $request->validate(
                [
                    'taxNo' => 'required|string|max:255',
                    'taxOffice' => 'required|string|max:255',
                    'address' => 'required|string|max:255',
                ]
            );

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'tax_no' => $request->taxNo,
                'tax_office' => $request->taxOffice,
                'address' => $request->address,
                'bearer_token' => Str::random(60),
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
                'bearer_token' => Str::random(60),
                'social_platform' => $request->socialPlatform,
                'social_media' => $request->socialMedia,
            ]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }
}
