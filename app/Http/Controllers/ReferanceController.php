<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CampaignUsers;
use App\Models\CampaignUserLogs;
use App\Models\Campaigns;
use App\Http\Controllers\Traits\BalanceTrait;
use Carbon\Carbon;

class ReferanceController extends Controller
{
    public function __construct()
    {
        $this->balanceTrait = new BalanceTrait();
    }

    public function index(Request $request, $key, $campaign)
    {
        $mainUrl = $request->getSchemeAndHttpHost() . '/ref/' . $key . '/' . $campaign;
        $refUrl = CampaignUsers::where('short_url', $mainUrl)->first();
        $ip = $this->getClientIp();

        if (!$refUrl) {
            return abort(404);
        }

        $findCampaign = Campaigns::find($campaign);
        $expireDate = false;

        if ($findCampaign->time){
            $expireDate = Carbon::parse($findCampaign->time);
            $expireDate = $expireDate->isPast();
        }


        if (!$findCampaign || $findCampaign->status != 'active' || $expireDate) {
            return abort(404);
        }

        $inf_revenue = 0;
        $multiple_click = 0;
        if ($findCampaign->type == 'click' || $findCampaign->type == 'multiple') {
            $inf_revenue = $findCampaign->tbm;
            $multiple_click = $findCampaign->multiple_click;
        }

        $log = CampaignUserLogs::where('ip_address', $ip)->where('campaign_id', $refUrl->campaign_id)->first();
        if ($multiple_click) {
            $refUrl->click_count = $refUrl->click_count + 1;
            $refUrl->save();

            $this->createLog($refUrl->campaign_id, $refUrl->id, $ip, $inf_revenue, $request->header('User-Agent'), $findCampaign->user_id, $refUrl->user_id);
        } else if (!$log) {
            $refUrl->click_count = $refUrl->click_count + 1;
            $refUrl->save();

            $this->createLog($refUrl->campaign_id, $refUrl->id, $ip, $inf_revenue, $request->header('User-Agent'), $findCampaign->user_id, $refUrl->user_id);
        } else {
            $this->createLog($refUrl->campaign_id, $refUrl->id, $ip, 0, $request->header('User-Agent'), $findCampaign->user_id, $refUrl->user_id);
        }

        return redirect($refUrl->url . '?ref=' . $key . '&campaign=' . $campaign);
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
}
