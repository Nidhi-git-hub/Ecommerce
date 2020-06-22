<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banners(){
    	return view('Admin.Banner.Banners');
    }
    public function addBanner(){
    	return view('Admin.Banner.addBanner');
    }
}
