<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $faqs = Faq::orderBy('order', 'asc')->get();
            return view('faq.index', ['faqs' => $faqs]);
        } else {
            $faqs = Faq::where('status', 1)->orderBy('order', 'asc')->get();
        }
        return view('faq.index', ['faqs' => $faqs]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $allFaq = Faq::max('order');

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->order = $allFaq == 0 || $allFaq ? $allFaq + 1 : 0;
        $faq->save();

        return redirect()->back()->with('success', 'Soru başarıyla eklendi.');
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);

        if (!$faq) return redirect()->back()->with('error', 'Soru bulunamadı.');

        $faq->delete();

        return redirect()->back()->with('success', 'Soru başarıyla silindi.');
    }

    public function orderUp($id)
    {
        $faq = Faq::find($id);

        if ($faq->order == 0) return redirect()->back();

        $faq->order = $faq->order - 1;
        $faq->save();

        return redirect()->back();
    }

    public function orderDown($id)
    {
        $faqCount = Faq::count();
        $faq = Faq::find($id);

        if ($faq->order == $faqCount - 1) return redirect()->back();

        $faq->order = $faq->order + 1;
        $faq->save();

        return redirect()->back();
    }

    public function statusUpdate($id)
    {
        $faq = Faq::find($id);

        if (!$faq) return redirect()->back()->with('error', 'Soru bulunamadı.');

        $faq->status = !$faq->status;
        $faq->save();

        return redirect()->back();
    }
}
