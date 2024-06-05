<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaigns;
use App\Models\CampaignUsers;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Traits\GeneralFunctionsTrait;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->generalFunctions = new GeneralFunctionsTrait();
    }

    public function index()
    {
        if(auth()->user()->role == 'admin') {
            $campaigns = Campaigns::paginate(10);
        }else if(auth()->user()->role == 'merchant') {
            $campaigns = Campaigns::where('user_id', auth()->user()->id)->paginate(10);
        }else{
            $campaigns = CampaignUsers::where('user_id', auth()->user()->id)->paginate(10);
        }
        return view('campaign.index', ['campaigns' => $campaigns]);
    }

    public function subscribe($id)
    {
        $campaign = Campaigns::find($id);
        if(!$campaign){
            return redirect()->back()->with('error', 'Kampanya bulunamadı.');
        }

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

    public function store(Request $request)
    {
        if($request->type == 'multiple'){
            $request->validate([
                'sbm' => 'required|numeric',
                'tbm' => 'required|numeric',
                'multipleClick' => 'required',
            ]);
        }else if($request->type == 'sale'){
            $request->validate([
                'sbm' => 'required|numeric',
            ]);
        }else if($request->type == 'click'){
            $request->validate([
                'tbm' => 'required|numeric',
                'multipleClick' => 'required',
            ]);
        }

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
        }
        
        $newCampaign = new Campaigns();

        if($request->hasFile('image')){
            $imageName = $this->generalFunctions->saveImage($request->file('image'), 'campaigns');
            $newCampaign->image = "/images/campaigns/".$imageName;
        }

        $newCampaign->name = $request->name;
        $newCampaign->description = $request->desc ?? '';
        $newCampaign->link = $request->link;
        $newCampaign->type = $request->type;
        $newCampaign->tbm = $request->tbm ?? 0;
        $newCampaign->sbm = $request->sbm ?? 0;
        $newCampaign->ibm = $request->ibm ?? 0;
        $newCampaign->time = $request->time;
        $newCampaign->multiple_click = $request->multipleClick ?? 0;
        $newCampaign->user_id = auth()->user()->id;
        $newCampaign->save();

        return redirect()->back()->with('success', 'Kampanya başarıyla oluşturuldu.');
    }

    public function delete($id)
    {
        $campaign = Campaigns::find($id);
        if(!$campaign){
            return redirect()->back()->with('error', 'Kampanya bulunamadı.');
        }

        $campaign->delete();

        return redirect()->back()->with('success', 'Kampanya başarıyla silindi.');
    }
}
