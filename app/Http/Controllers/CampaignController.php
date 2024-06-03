<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaigns;
use App\Models\CampaignUsers;

class CampaignController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'admin') {
            $campaigns = Campaigns::paginate(10);
        }else{
            $campaigns = Campaigns::where('user_id', auth()->user()->id)->paginate(10);
        }
        return view('campaign.index', ['campaigns' => $campaigns]);
    }

    public function subscribe($id)
    {
        $campaign = Campaigns::find($id);
        if(!$campaign){
            return redirect()->back()->with('error', 'Kampanya bulunamadı.');
        }
        // dd($campaign);

        $campaignType = '';

        if($campaign->type == 'click'){
            $campaignType = 'tbm';
        }else if($campaign->type == 'sale'){
            $campaignType = 'sbm';
        }else if($campaign->type == 'multiple'){
            $campaignType = 'ibm';
        }

        $newCampaignUser = new CampaignUsers();
        $newCampaignUser->campaign_id = $campaign->id;
        $newCampaignUser->user_id = auth()->user()->id;
        $newCampaignUser->url = $campaign->link;
        $newCampaignUser->short_url = url('/ref/'.uniqid());
        $newCampaignUser->campaign_type = $campaignType;
        $newCampaignUser->save();

        return redirect()->back()->with('success', 'Kampanyaya başarıyla abone oldunuz.');
    }
}
