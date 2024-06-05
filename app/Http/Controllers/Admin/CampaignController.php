<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaigns;

class CampaignController extends Controller
{
    public function approve($id)
    {
        $campaign = Campaigns::find($id);
        if(!$campaign){
            return redirect()->back()->with('error', 'Kampanya bulunamadı.');
        }

        $campaign->status = 'active';
        $campaign->save();

        return redirect()->back()->with('success', 'Kampanya başarıyla onaylandı.');
    }

    public function reject($id)
    {
        $campaign = Campaigns::find($id);
        if(!$campaign){
            return redirect()->back()->with('error', 'Kampanya bulunamadı.');
        }

        $campaign->status = 'inactive';
        $campaign->save();

        return redirect()->back()->with('success', 'Kampanya başarıyla reddedildi.');
    }
}
