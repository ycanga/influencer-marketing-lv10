<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MoneyDemands;
use App\Models\User;

class MoneyDemandController extends Controller
{
    public function reject($id)
    {
        $moneyDemand = MoneyDemands::find($id);

        if (!$moneyDemand) {
            return redirect()->back()->with('error', 'Para çekme talebi bulunamadı.');
        }

        $moneyDemand->status = 'failed';
        $moneyDemand->save();
        return redirect()->back()->with('success', 'Para çekme talebi başarıyla reddedildi.');
    }

    public function approve($id)
    {
        $moneyDemand = MoneyDemands::find($id);

        if (!$moneyDemand) {
            return redirect()->back()->with('error', 'Para çekme talebi bulunamadı.');
        }

        $user = User::find($moneyDemand->user_id);

        if($user->balance < $moneyDemand->amount) {
            return redirect()->back()->with('error', 'Kullanıcının bakiyesi yetersiz.');
        }

        $user->balance -= $moneyDemand->amount;
        $user->save();

        $moneyDemand->status = 'success';
        $moneyDemand->save();
        return redirect()->back()->with('success', 'Para çekme talebi başarıyla onaylandı.');
    }
}
