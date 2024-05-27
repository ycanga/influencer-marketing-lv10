<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BalanceHistory;

class BalanceTransferController extends Controller
{
    public function index()
    {
        $balanceTransfers = BalanceHistory::where('status', 'pending')->where('type', 'iban')->with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.balance.index', ['balanceTransfers' => $balanceTransfers]);
    }

    public function approve($id)
    {
        $balanceTransfer = BalanceHistory::find($id);
        
        if (!$balanceTransfer) {
            return redirect()->back()->with('error', 'Bakiye transfer isteği bulunamadı.');
        }

        //update user balance
        $user = $balanceTransfer->user;
        $user->balance += $balanceTransfer->amount;
        $user->save();

        $balanceTransfer->status = 'success';
        $balanceTransfer->save();
        return redirect()->back()->with('success', 'Bakiye transfer isteği onaylandı.');
    }

    public function reject($id)
    {
        $balanceTransfer = BalanceHistory::find($id);

        if (!$balanceTransfer) {
            return redirect()->back()->with('error', 'Bakiye transfer isteği bulunamadı.');
        }

        $balanceTransfer->status = 'failed';
        $balanceTransfer->save();
        return redirect()->back()->with('success', 'Bakiye transfer isteği iptal edildi.');
    }
}
