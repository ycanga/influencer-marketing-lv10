<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->paginate(10);
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
        return redirect()->back()->with('success', 'Kullanıcı başarıyla silindi.');
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
}
