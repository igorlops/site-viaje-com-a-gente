<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Destination;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        $banner = Banner::where('active', true)->first();
        $destinations = Destination::where('is_featured', true)->get();
        
        // Fetch social links and index them by name
        $socialLinks = SocialLink::where('active', true)->get()->keyBy(function ($item) {
            return strtolower($item->name);
        });

        return view('home', compact('banner', 'destinations', 'socialLinks'));
    }
}
