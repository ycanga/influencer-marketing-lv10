<?php

namespace App\Http\Controllers\Traits;

use App\Models\User;
use App\Models\BalanceHistory;
use App\Models\Campaigns;
use App\Models\PaymentModels;
use App\Models\CampaignUsers;

class BalanceTrait
{
    public function updateBalance($userId, $amount, $campaignUserID = null, $campaignID=null, $purchaseValue=null)
    {
        $user = User::find($userId);
        $user->balance += $amount;
        $user->save();

        if($campaignUserID){
            $campaignUser = User::find($campaignUserID);
            $campaignUser->balance -= $amount;
            $campaignUser->save();
        }else if($campaignID){
            $campaignUserFind = Campaigns::find($campaignID);
            $campaignUser = User::find($campaignUserFind->user_id);
            $campaignUser->balance -= $amount;
            $campaignUser->save();
        }

        $findCampaign = CampaignUsers::where('campaign_id', $campaignID)->where('user_id', $userId)->first();
        $findCampaign->revenue += $amount;
        $findCampaign->save();

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

    public function getClientIp()
    {
        $ipAddress = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // Paylaşılan internet üzerinden IP
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // Proxy üzerinden gelen IP
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // Remote adres
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }
        // X-Forwarded-For başlığı birden fazla IP içerebilir, ilkini alalım
        $ipArray = explode(',', $ipAddress);
        return trim($ipArray[0]);
    }

    public function updateUserBalance($userId, $amount)
    {
        $user = User::find($userId);
        $user->balance += $amount;
        $user->save();

        return true;
    }
}
