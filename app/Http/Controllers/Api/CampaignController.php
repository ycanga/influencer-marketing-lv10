<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampaignUsers;
use App\Http\Requests\PurchaseApiRequest;

class CampaignController extends Controller
{
    public function purchase(PurchaseApiRequest $request)
    {
        $mainUrl = $request->getSchemeAndHttpHost() . '/ref/' . $request->refCode;
        $campaignUser = CampaignUsers::where('short_url', $mainUrl)->first();
        if(!$campaignUser){
            return response()->json(['error' => 'Kampanya bulunamadı.'], 404);
        }

        

        return response()->json(['success' => 'Kampanya başarıyla satın alındı.']);
    }
}
