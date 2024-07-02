<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampaignCategories;

class CampaignSettingsController extends Controller
{
    public function index()
    {
        $categories = CampaignCategories::paginate(10);
        return view('admin.campaign-settings.index',['categories' => $categories]);
    }
}
