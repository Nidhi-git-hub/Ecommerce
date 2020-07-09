<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Banner;

class BannerController extends Controller
{
    public function banners()
    {
    	$banner=Banner::all();
    	return view('Admin.Banner.Banners',compact('banner'));
    }
    public function addBanner(Request $request)
    {
    	if($request->isMethod('post')){

    		$file=$request->file('image');
            $filename='image' . time().'.'.$request->image->extension();
            $file->move("upload/",$filename);

    		$banner=$request->all();
    		$banner= new Banner;
    	    $banner->name=$request->banner_name;
    	    $banner->text_style=$request->text_style;
    	    $banner->sort_order=$request->sort_order;
            $banner->content=$request->banner_content;
    	    $banner->link=$request->link;
    	    $banner->image=$filename;
            $banner->save();
            if($banner)
        	{
                Alert::success('Banner Successfully Added!', 'Success Message');
    			return redirect('/admin/add-banner');
    		}
    	}
    	return view('Admin.Banner.addBanner');
    }
    public function editBanner(Request $request,$id=null)
    {
    	if($request->isMethod('post')){
            $banners = $request->all();
                if($request->hasFile('image'))
            {
                $file=$request->file('image');
                $filename='image'.time().'.'.$request->image->extension();
                $file->move("upload/",$filename);
    
                $banners=Banner::find($request->id);
                $banners->name=$request->banner_name;
    	    	$banners->text_style=$request->text_style;
    	    	$banners->sort_order=$request->sort_order;
            	$banners->content=$request->banner_content;
    	    	$banners->link=$request->link;
    	    	$banners->image=$filename;
                $updated=$banners->save();
            }
            else
            {
                $banners=Banner::find($request->id);
                $banners->name=$request->banner_name;
    	    	$banners->text_style=$request->text_style;
    	    	$banners->sort_order=$request->sort_order;
            	$banners->content=$request->banner_content;
    	    	$banners->link=$request->link;
                $updated=$banners->save();
            }
            if($updated){
                Alert::success('Banner Successfully Updated!', 'Success Message');
                return redirect('/admin/banners');
            }
        }
    	$banners = Banner::where(['id'=>$id])->first();
    	return view('Admin.Banner.editBanner')->with(compact('banners'));

    }
    public function deleteBanner($id)
    {
        $banner=Banner::find($id)->delete();
        if($banner)
        {
            Alert::success('Banner Deleted Successfully!', 'Success Message');
            return redirect('/admin/banners');
        }
    }
    public function updateStatus(Request $request,$id=null){
        $data= $request->all(); 
        Banner::where('id',$data['id'])->update(['status'=>$data['status']]);
    }
}
