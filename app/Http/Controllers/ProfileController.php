<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\GeneralFunctionsTrait;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->generalFunctions = new GeneralFunctionsTrait();
    }

    public function index()
    {
        return view('profile.index');
    }

    public function disable(Request $request)
    {
        $request->user()->update(['status' => 'inactive']);
        $request->user()->delete();

        return redirect()->route('login');
    }

    public function update(ProfileRequest $request)
    {
        $request->validated();

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $imageName = $this->generalFunctions->saveImage($request->file('photo'), 'user-avatar');
            $data['photo'] = 'images/user-avatar/' . $imageName;
        }

        if (empty($data['password']) || empty($data['password_confirmation'])) {
            unset($data['password']);
            unset($data['password_confirmation']);
        } else {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);

            $data['password'] = bcrypt($data['password']);
        }

        $request->user()->update($data);


        return redirect()->route('profile.index')->with('success', 'Profil ayarlarınız başarıyla güncellendi.');
    }

    public function refreshApiKey(Request $request)
    {
        $request->user()->update(['bearer_token' => Str::random(60)]);

        return redirect()->route('profile.index')->with('success', 'API Key başarıyla güncellendi.');
    }
}
