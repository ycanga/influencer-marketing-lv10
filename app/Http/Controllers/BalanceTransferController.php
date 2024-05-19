<?php

namespace App\Http\Controllers;

use App\Models\BalanceHistory;
use Illuminate\Http\Request;

class BalanceTransferController extends Controller
{
    public function index()
    {
        $userBalance = BalanceHistory::where('user_id', auth()->id())->get();
        $totalBalance = BalanceHistory::where('user_id', auth()->id())->where('status', 'success')->sum('amount');
        return view('balance.index',['userBalance' => $userBalance, 'totalBalance' => $totalBalance]);
    }
}
