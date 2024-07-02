<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampaignCategories;
use Illuminate\Support\Str;
use App\Models\Campaigns;

class CampaignSettingsController extends Controller
{
    public function index()
    {
        $campaignCategories = CampaignCategories::paginate(10);
        return view('admin.campaign-settings.index',['campaignCategories' => $campaignCategories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|string',
        ]);
        
        $campaignCategory = new CampaignCategories();

        if($request->parent_id != 'main'){
            $parentCategory = CampaignCategories::find($request->parent_id);
            if($parentCategory == null){
                return redirect()->back()->with('error', 'Kategori bulunamadı.');
            }
            $campaignCategory->parent_id = $request->parent_id;
        }else{
            $campaignCategory->parent_id = null;
        }

        $campaignCategory->name = $request->name;
        $campaignCategory->slug = Str::slug($request->name);
        $campaignCategory->created_by = auth()->user()->id;
        $campaignCategory->save();

        return redirect()->back()->with('success', 'Kategori başarıyla eklendi.');
    }

    public function delete($id)
    {
        $campaignCategory = CampaignCategories::find($id);
        if($campaignCategory == null){
            return redirect()->back()->with('error', 'Kategori bulunamadı.');
        }

        Campaigns::where('category_id', $id)->delete();

        $campaignCategory->delete();
        return redirect()->back()->with('success', 'Kategori başarıyla silindi.');
    }
}
