<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneyDemands;
use App\Http\Requests\MoneyDemandRequest;

class MoneyDemandController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'admin') {
            $moneyDemands = MoneyDemands::with('user')->paginate(10);
        } else {
            $moneyDemands = MoneyDemands::where('user_id', auth()->user()->id)->paginate(10);
        }
        return view('money-demand.index', ['moneyDemands' => $moneyDemands]);
    }

    public function store(MoneyDemandRequest $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        $userBalance = auth()->user()->balance;

        if($userBalance < $request->amount) {
            return redirect()->back()->with('error', 'Bakiyeniz yetersiz.');
        }

        $moneyDemand = new MoneyDemands();
        $moneyDemand->user_id = auth()->user()->id;
        $moneyDemand->amount = $request->amount;
        $moneyDemand->status = 'pending';
        $moneyDemand->transaction_note = $request->transaction_note ?? null;
        $moneyDemand->save();

        return redirect()->back()->with('success', 'Para çekme talebi başarıyla oluşturuldu.');
    }
}
