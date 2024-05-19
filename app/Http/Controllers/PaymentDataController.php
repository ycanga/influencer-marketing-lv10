<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentDataRequest;
use App\Models\PaymentData;
use Illuminate\Http\Request;

class PaymentDataController extends Controller
{
    public function index()
    {
        $paymentData = PaymentData::where('user_id', auth()->id())->first();

        if($paymentData) {
            return view('payment.index', $paymentData);
        }

        return view('payment.index');
    }

    public function store(PaymentDataRequest $request)
    {
        $request->validated();

        $paymentData = PaymentData::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'bank_name' => $request->bank_name,
                'iban' => $request->account_number,
                'account_username' => $request->account_username,
                'desc' => $request->desc,
            ]
        );

        if (!$paymentData) {
            return back()->with('error', 'Ödeme bilgileriniz kaydedilirken bir hata oluştu. Lütfen tekrar deneyin.');
        }

        return back()->with('success', 'Ödeme bilgileriniz başarıyla kaydedildi.');
    }
}
