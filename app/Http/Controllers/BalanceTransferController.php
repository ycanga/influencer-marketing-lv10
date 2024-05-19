<?php

namespace App\Http\Controllers;

use App\Models\BalanceHistory;
use Illuminate\Http\Request;
use App\Models\PaymentModels;

class BalanceTransferController extends Controller
{
    public function index()
    {
        $userBalance = BalanceHistory::where('user_id', auth()->id())->get();
        $totalBalance = BalanceHistory::where('user_id', auth()->id())->where('status', 'success')->sum('amount');
        $paymentModels = PaymentModels::where('status', 1)->get();
        return view('balance.index',['userBalance' => $userBalance, 'totalBalance' => $totalBalance, 'paymentModels' => $paymentModels]);
    }
}
