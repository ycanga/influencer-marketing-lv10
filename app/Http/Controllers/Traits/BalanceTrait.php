<?php

namespace App\Http\Controllers\Traits;

use App\Models\User;
use App\Models\BalanceHistory;
use App\Models\PaymentModels;

class BalanceTrait
{
    public function updateBalance($userId, $amount)
    {
        $user = User::find($userId);
        $user->balance += $amount;
        $user->save();

        return true;
    }

    public function requiredData()
    {
        $userBalance = BalanceHistory::where('user_id', auth()->id())->orderBy('created_at', 'desc')->paginate(10);
        $totalBalance = BalanceHistory::where('user_id', auth()->id())->where('status', 'success')->sum('amount');
        $paymentModels = PaymentModels::where('status', 1)->get();
        $lastId = BalanceHistory::latest('id')->first();

        return ['userBalance' => $userBalance, 'totalBalance' => $totalBalance, 'paymentModels' => $paymentModels, 'lastId' => $lastId];
    }
}
