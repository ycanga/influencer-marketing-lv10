<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public function index(Request $request)
    {
        $mainUrl = $request->getSchemeAndHttpHost();
        return view('integration.index', ['mainUrl' => $mainUrl]);
    }
}
