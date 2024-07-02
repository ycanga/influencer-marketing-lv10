<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Traits\GeneralFunctionsTrait;

class UserController extends Controller
{
    public function __construct()
    {
        $this->generalFunctions = new GeneralFunctionsTrait();
    }

    public function index()
    {
        $users = User::withTrashed()->where('id', '!=', auth()->user()->id)->paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }

    public function block($id)
    {
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı.');
        }
        $user->status = 'inactive';
        $user->save();
        return redirect()->back()->with('success', 'Kullanıcı başarıyla bloke edildi.');
    }

    public function unblock($id)
    {
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı.');
        }
        $user->status = 'active';
        $user->save();
        return redirect()->back()->with('success', 'Kullanıcı başarıyla aktif edildi.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı.');
        }
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'Kullanıcı başarıyla silindi.');
    }

    public function updateRole($id)
    {
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı.');
        }

        if($user->role == 'admin'){
            $user->role = 'user';
        }else if($user->role == 'user'){
            $user->role = 'admin';
        }
        $user->save();
        return redirect()->back()->with('success', 'Kullanıcı rolü başarıyla güncellendi.');
    }

    public function show($id)
    {
        $user = User::withTrashed()->find($id);
        if(!$user){
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı.');
        }
        return view('admin.users.show', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required',
            'balance' => 'required|numeric',
            'status' => 'required',
            'role' => 'required'
        ]);

        $user = User::find($id);
        if(!$user){
            return redirect()->back()->with('error', 'Kullanıcı bulunamadı.');
        }

        if($request->password){
            $request->validate([
                'password' => 'required|min:8|confirmed'
            ]);

            $user->password = bcrypt($request->password);
        }

        if($request->hasFile('photo')){
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $this->generalFunctions->updateUserAvatar($user, $request->file('photo'));
        }

        $user->balance = $request->balance;
        $user->role = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->save();
        return redirect()->back()->with('success', 'Kullanıcı başarıyla güncellendi.');
    }
}
