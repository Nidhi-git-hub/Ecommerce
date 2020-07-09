<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
    	if($request->isMethod('post')){
    		$category=$request->all();
    		$category= new Category;
    	    $category->name=$request->category_name;
    	    $category->parent_id=$request->parent_id;
            $category->url=$request->category_url;
    	    $category->description=$request->category_description;
            $category->save();
            if($category)
        	{
                Alert::success('Category Successfully Added!', 'Success Message');
    			return redirect('/admin/add-category');
    		}
    	}
    	$levels = Category::where(['parent_id'=>0])->get();
    	return view('Admin.Category.addCategory')->with(compact('levels'));
    }
    public function displayCategory()
    {
        $category=Category::all();
        return view('Admin.Category.displayCategory',compact('category'));
    }
    public function editCategory(Request $request,$id=null)
    {
        if($request->isMethod('post')){
            $category = $request->all();
            $category=Category::find($request->id);
            $category->name=$request->category_name;
            $category->parent_id=$request->parent_id;
            $category->url=$request->category_url;
            $category->description=$request->category_description;
            $updated=$category->save();

            if($updated){
                Alert::success('Category Successfully Updated!', 'Success Message');
                return redirect('/admin/display-category');
            }
        }
        $category=Category::where(['id'=>$id])->first();
        $levels = Category::where(['parent_id'=>0])->get();
        return view('Admin.Category.editCategory',compact('category','levels'));
    }
    public function deleteCategory($id)
    {
        $category=Category::find($id)->delete();
        if($category)
        {
            Alert::success('Category Deleted Successfully!', 'Success Message');
            return redirect('/admin/display-category');
        }
    }
    public function updateStatus(Request $request,$id=null){
        $data= $request->all(); 
        Category::where('id',$data['id'])->update(['status'=>$data['status']]);
    }
}