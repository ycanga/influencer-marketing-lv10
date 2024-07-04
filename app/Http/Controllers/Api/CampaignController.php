<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampaignUsers;
use App\Http\Requests\PurchaseApiRequest;
use App\Models\Campaigns;
use App\Http\Controllers\Traits\BalanceTrait;
use App\Models\CampaignUserLogs;
use App\Models\User;
use App\Models\Settings;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->balanceTrait = new BalanceTrait();
    }

    public function purchase(PurchaseApiRequest $request)
    {
        $mainUrl = $request->getSchemeAndHttpHost() . '/ref/' . $request->refCode. '/' . $request->campaignId;
        $campaignUser = CampaignUsers::where('short_url', $mainUrl)->first();
        if(!$campaignUser){
            return response()->json(['error' => 'Kampanya bulunamadı.'], 404);
        }

        $campaignUser->view_count = $campaignUser->view_count + 1;
        $campaignUser->total_revenue = $campaignUser->total_revenue + $request->purchaseValue;
        $campaignUser->save();

        $campaign = Campaigns::find($request->campaignId);
        if(!$campaign){
            return response()->json(['error' => 'Kampanya bulunamadı.'], 404);
        }
        
        // Marka kullanıcısından satın alma komisyonu düşülür.
        $settings = Settings::first();
        $findCampaignUser = User::find($campaign->user_id);
        $findCampaignUser->balance -= $request->purchaseValue * $settings->site_balance_rate / 100;

        $this->balanceTrait->updateBalance($campaignUser->user_id, $this->calculateInfRevenue($request->purchaseValue, $campaignUser->campaign_id), null, $campaignUser->campaign_id);
        $this->updateCampaignUserLogs($request, $this->calculateInfRevenue($request->purchaseValue, $campaignUser->campaign_id));

        return response()->json(['success' => 'Kampanya kullanımı başarılı bir şekilde gerçekleştirildi.']);
    }

    public function calculateInfRevenue($purchaseValue, $campaignId)
    {
        $campaign = Campaigns::find($campaignId);
        $campaignRate = $campaign->sbm;

        return ($purchaseValue * $campaignRate) / 100;
    }

    public function updateCampaignUserLogs(Request $request, $infRevenue)
    {
        $campaignUser = CampaignUserLogs::where('ip_address', $request->ipAddress )->where('campaign_id', $request->campaignId)->first();
        if(!$campaignUser){
            return response()->json(['error' => 'Kampanya kullanıcısı bulunamadı.'], 404);
        }

        $campaignUser->revenue = $campaignUser->revenue + $request->purchaseValue;
        $campaignUser->inf_revenue = $campaignUser->inf_revenue + $infRevenue;
        $campaignUser->save();
    }
}
