<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaigns;

class HomeController extends Controller
{
    public function index()
    {
        $campaigns = Campaigns::where('status', 'active')->with('users')->orderBy('created_at', 'desc')->limit(5)->get();
        return view('home', ['campaigns' => $campaigns]);
    }
}
