<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaigns;
use App\Models\CampaignUsers;
use App\Http\Controllers\Traits\GeneralFunctionsTrait;
use App\Http\Requests\CampaignRequest;

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->generalFunctions = new GeneralFunctionsTrait();
    }

    public function index()
    {
        $users = [];
        if (auth()->user()->role == 'admin') {
            $campaigns = Campaigns::with('merchant')->paginate(10);
            foreach ($campaigns as $campaign) {
                // Kampanyaya ait benzersiz kullanıcı sayısını al
                $uniqueUserCount = CampaignUsers::where('campaign_id', $campaign->id)
                    ->whereNotIn('user_id', $users)
                    ->distinct('user_id')
                    ->count('user_id');

                // Kullanıcı ID'lerini mevcut listeye ekle
                $userIds = CampaignUsers::where('campaign_id', $campaign->id)
                    ->pluck('user_id')
                    ->toArray();
                $users = array_merge($users, $userIds);

                // Benzersiz kullanıcı sayısını kampanyaya ekle
                $campaign->users = $uniqueUserCount;
            }
        } else if (auth()->user()->role == 'merchant') {
            $campaigns = Campaigns::where('user_id', auth()->user()->id)->with('merchant')->paginate(10);
            foreach ($campaigns as $campaign) {
                // Kampanyaya ait benzersiz kullanıcı sayısını al
                $uniqueUserCount = CampaignUsers::where('campaign_id', $campaign->id)
                    ->whereNotIn('user_id', $users)
                    ->distinct('user_id')
                    ->count('user_id');

                // Kullanıcı ID'lerini mevcut listeye ekle
                $userIds = CampaignUsers::where('campaign_id', $campaign->id)
                    ->pluck('user_id')
                    ->toArray();
                $users = array_merge($users, $userIds);

                // Benzersiz kullanıcı sayısını kampanyaya ekle
                $campaign->users = $uniqueUserCount;
            }
        } else {
            $userCampaigns = CampaignUsers::where('user_id', auth()->user()->id)->get();
            $campaigns = Campaigns::whereIn('id', $userCampaigns->pluck('campaign_id'))->with('merchant')->paginate(10);

            foreach ($campaigns as $campaign) {
                $userCampaign = $userCampaigns->firstWhere('campaign_id', $campaign->id);
                $campaign->revenue = $userCampaign ? $userCampaign->revenue : 0;
                $campaign->short_url = $userCampaign ? $userCampaign->short_url : '';
            }
        }
        return view('campaign.index', ['campaigns' => $campaigns]);
    }

    public function subscribe($id)
    {
        $campaign = Campaigns::find($id);
        if (!$campaign) {
            return redirect()->back()->with('error', 'Kampanya bulunamadı.');
        }

        $campaignType = '';

        if ($campaign->type == 'click') {
            $campaignType = 'tbm';
        } else if ($campaign->type == 'sales') {
            $campaignType = 'sbm';
        } else if ($campaign->type == 'multiple') {
            $campaignType = 'ibm';
        }

        $newCampaignUser = new CampaignUsers();
        $newCampaignUser->campaign_id = $campaign->id;
        $newCampaignUser->user_id = auth()->user()->id;
        $newCampaignUser->url = $campaign->link;
        $newCampaignUser->short_url = url('/ref/' . uniqid() . "/" . $campaign->id);
        $newCampaignUser->campaign_type = $campaignType;
        $newCampaignUser->save();

        return redirect()->back()->with('success', 'Kampanyaya başarıyla abone oldunuz.');
    }

    public function unsubscribe($id)
    {
        $campaign = Campaigns::find($id);
        if (!$campaign) {
            return redirect()->back()->with('error', 'Kampanya bulunamadı.');
        }

        $campaignUser = CampaignUsers::where('campaign_id', $campaign->id)->where('user_id', auth()->user()->id)->first();
        if (!$campaignUser) {
            return redirect()->back()->with('error', 'Kampanyaya abone değilsiniz.');
        }

        $campaignUser->delete();

        return redirect()->back()->with('success', 'Kampanyadan başarıyla ayrıldınız.');
    }

    public function store(CampaignRequest $request)
    {
        if ($request->type == 'multiple') {
            $request->validate([
                'sbm' => 'required|numeric',
                'tbm' => 'required|numeric',
                'multipleClick' => 'required',
            ]);
        } else if ($request->type == 'sales') {
            $request->validate([
                'sbm' => 'required|numeric',
            ]);
        } else if ($request->type == 'click') {
            $request->validate([
                'tbm' => 'required|numeric',
                'multipleClick' => 'required',
            ]);
        }
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
        }

        $newCampaign = new Campaigns();

        if ($request->hasFile('image')) {
            $imageName = $this->generalFunctions->saveImage($request->file('image'), 'campaigns');
            $newCampaign->image = "/images/campaigns/" . $imageName;
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
        if (!$campaign) {
            return redirect()->back()->with('error', 'Kampanya bulunamadı.');
        }

        $campaign->delete();

        return redirect()->back()->with('success', 'Kampanya başarıyla silindi.');
    }

    public function all()
    {
        if(auth()->user()->role == 'admin') {
            $campaigns = Campaigns::where('status', 'active')->with('merchant')->paginate(10);
        } else if(auth()->user()->role == 'merchant') {
            $campaigns = Campaigns::where('user_id', '!=',auth()->user()->id)->where('status', 'active')->with('merchant')->paginate(10);
        } else {
            $userCampaigns = CampaignUsers::where('user_id', auth()->user()->id)->get();
            $campaigns = Campaigns::whereNotIn('id', $userCampaigns->pluck('campaign_id'))->where('status', 'active')->with('merchant')->paginate(10);
        }

        return view('campaign.all', ['campaigns' => $campaigns]);
    }
}
