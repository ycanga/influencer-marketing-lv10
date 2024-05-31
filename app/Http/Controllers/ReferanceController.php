<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CampaignUsers;
use App\Models\CampaignUserLogs;

class ReferanceController extends Controller
{
    public function index(Request $request,$key)
    {
        $mainUrl = $request->getSchemeAndHttpHost().'/ref/'.$key;
        $refUrl = CampaignUsers::where('short_url', $mainUrl)->first();

        if(!$refUrl){
            return redirect('/');
        }

        // dd($refUrl);

        $log = new CampaignUserLogs();
        $log->campaign_id = $refUrl->campaign_id;
        $log->campaign_user_id = $refUrl->id;
        $log->ip_address = $request->ip();
        $log->user_agent = $request->header('User-Agent');
        $log->save();


        return redirect($refUrl->url.'?ref='.$key);
    }
}
