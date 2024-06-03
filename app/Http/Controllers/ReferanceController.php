<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CampaignUsers;
use App\Models\CampaignUserLogs;
use App\Models\Campaigns;
use App\Models\User;
use App\Http\Controllers\Traits\BalanceTrait;

class ReferanceController extends Controller
{
    public function __construct()
    {
        $this->balanceTrait = new BalanceTrait();
    }

    public function index(Request $request, $key, $campaign)
    {
        $mainUrl = $request->getSchemeAndHttpHost() . '/ref/' . $key.'/'.$campaign;
        $refUrl = CampaignUsers::where('short_url', $mainUrl)->first();

        if (!$refUrl) {
            return redirect('/');
        }

        $findCampaign = Campaigns::find($refUrl->campaign_id);
        if (!$findCampaign) {
            return redirect('/');
        }

        $inf_revenue = 0;
        $multiple_click = 0;
        if ($findCampaign->type == 'click') {
            $inf_revenue = $findCampaign->tbm;
            $multiple_click = $findCampaign->multiple_click;
        } else if ($findCampaign->type == 'multiple') {
            $inf_revenue = $findCampaign->ibm;
            $multiple_click = $findCampaign->multiple_click;
        }

        $log = CampaignUserLogs::where('ip_address', $request->ip())->where('campaign_id', $refUrl->campaign_id)->first();
        if ($multiple_click) {
            $refUrl->click_count = $refUrl->click_count + 1;
            $refUrl->save();

            $this->createLog($refUrl->campaign_id, $refUrl->id, $request->ip(), $inf_revenue, $request->header('User-Agent'), $findCampaign->user_id, $refUrl->user_id);
            
        } else if (!$log) {
            $refUrl->click_count = $refUrl->click_count + 1;
            $refUrl->save();

            $this->createLog($refUrl->campaign_id, $refUrl->id, $request->ip(), $inf_revenue, $request->header('User-Agent'), $findCampaign->user_id, $refUrl->user_id);
        } else {
            $this->createLog($refUrl->campaign_id, $refUrl->id, $request->ip(), 0, $request->header('User-Agent'), $findCampaign->user_id, $refUrl->user_id);
        }
        
        return redirect($refUrl->url . '?ref=' . $key.'&campaign='.$campaign);
    }
    
    public function createLog($campaign_id, $campaign_user_id, $ip_address, $inf_revenue, $user_agent, $campaignUserID, $infID)
    {
        $log = new CampaignUserLogs();
        $log->campaign_id = $campaign_id;
        $log->campaign_user_id = $campaign_user_id;
        $log->ip_address = $ip_address;
        $log->inf_revenue = $inf_revenue;
        $log->user_agent = $user_agent;
        $log->save();
        $this->balanceTrait->updateBalance($infID, $inf_revenue, $campaignUserID, $campaign_id);
        
        return true;
    }
}
