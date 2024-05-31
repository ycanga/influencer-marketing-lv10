<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaigns;

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
}
