<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Http\Requests\SettingsRequest;
use App\Http\Controllers\Traits\GeneralFunctionsTrait;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->generalFunctions = new GeneralFunctionsTrait();
    }

    public function index()
    {
        $settings = Settings::first();
        return view('admin.settings.index', ['settings' => $settings]);
    }

    public function store(SettingsRequest $request)
    {
        $request->validate([
            'site_title' => 'required',
            'site_description' => 'required',
            'site_keywords' => 'required',
            'site_min_balance' => 'required',
        ]);
        
        $data = $request->all();

        if($request->hasFile('site_logo')) {
            $request->validate([
                'site_logo' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $imageName = $this->generalFunctions->saveImage($request->site_logo, 'site_logo');
            $data['site_logo'] = 'images/site_logo/' . $imageName;
        }

        if($request->hasFile('site_favicon')) {
            $request->validate([
                'site_favicon' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $imageName = $this->generalFunctions->saveImage($request->site_favicon, 'site_favicon');
            $data['site_favicon'] = 'images/site_favicon/' . $imageName;
        }

        $settings = Settings::first();
        if ($settings) {
            $settings->update($data); 
        } else {
            Settings::create($data);
        }

        return back()->with('success', 'Ayarlar başarıyla güncellendi.');
    }
}
