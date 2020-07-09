<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use App\Product;

class FrontendController extends Controller
{
    public function index(){
    	$banners= Banner::where('status','1')->orderby('sort_order','asc')->get();
    	$category= Category::with('category')->where(['parent_id'=>0])->get();
    	$products= Product::get();
    	return view('Frontend.index',compact('banners','category','products'));
    }
    public function category($category_id){
    	$category= Category::with('category')->where(['parent_id'=>0])->get();
    	$products= Product::where(['category_id'=>$category_id])->get();
    	$product_name = Product::where(['category_id'=>$category_id])->first();
    	return view('Frontend.category',compact('category','products','product_name'));
    }
}
