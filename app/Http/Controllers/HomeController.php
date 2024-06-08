<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaigns;
use App\Models\CampaignUsers;

class HomeController extends Controller
{
    public function index()
    {
        $activeUserCampaigns = CampaignUsers::where('user_id', auth()->user()->id)->get();
        $campaigns = Campaigns::where('status', 'active')->whereNotIn('id', $activeUserCampaigns->pluck('campaign_id'))->with('merchant')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('home', ['campaigns' => $campaigns]);
    }
}
