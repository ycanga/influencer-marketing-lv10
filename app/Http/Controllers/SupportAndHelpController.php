<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supports;
use App\Http\Requests\SupportRequest;

class SupportAndHelpController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'admin') {
            $supports = Supports::where('parent_id', null)->orderBy('created_at', 'desc')->paginate(10);
        }else {
            $supports = Supports::where('user_id', auth()->id())->where('parent_id', null)->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('support.index', ['supports' => $supports]);
    }

    public function store(SupportRequest $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Supports::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Destek talebiniz başarıyla oluşturuldu.');
    }

    public function show($id)
    {
        if (auth()->user()->role != 'admin') {
            $support = Supports::where('user_id', auth()->id())->where('id', $id)->with('messages')->first();
        } else {
            $support = Supports::where('id', $id)->with('messages')->first();
        }

        if (!$support) {
            return redirect()->route('support.index')->with('error', 'Destek talebi bulunamadı.');
        }

        return view('support.show', ['support' => $support]);
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'parent_id' => 'required',
            'replied_user_id' => 'required',
            'reply_message' => 'required|string',
        ]);
        
        $support = Supports::where('id', $request->parent_id)->where('id', $id)->first();
        if (!$support) {
            return redirect()->route('support.index')->with('error', 'Destek talebi bulunamadı.');
        }

        $support->update([
            'status' => 'replied',
        ]);

        Supports::create([
            'user_id' => auth()->id(),
            'parent_id' => $support->id,
            'subject' => 'Re: ' . $support->subject,
            'message' => $request->reply_message,
            'replied_user_id' => auth()->user()->role == 'admin' ? auth()->id() : null,
            'type' => 'message',
            'status' => 'replied',
        ]);

        return redirect()->back()->with('success', 'Destek talebine başarıyla yanıt verildi.');
    }

    public function close($id)
    {
        $support = Supports::where('id', $id)->first();
        if (!$support) {
            return redirect()->route('support.index')->with('error', 'Destek talebi bulunamadı.');
        }

        $support->update([
            'status' => 'closed',
        ]);

        return redirect()->route('support.index')->with('success', 'Destek talebi başarıyla kapatıldı.');
    }
}
