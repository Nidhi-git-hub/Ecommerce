<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {
        if($request->isMethod('post')){
            $file=$request->file('picture');
            $filename='picture' . time().'.'.$request->picture->extension();
            $file->move("upload/",$filename);

            $product = $request->all();
            $product= new Product;
            $product->category_id=$request->category_id;
            $product->name=$request->product_name;
            $product->code=$request->product_code;
            $product->description=$request->product_description;
            $product->price=$request->product_price;
            $product->picture=$filename;
            $product->save();
            if($product)
            {
                Alert::success('Product Successfully Added!', 'Success Message');
                return redirect('/admin/add-product');
            }   
        }
        //Category Dropdown Menu Code
        $category = Category::where(['parent_id'=>0])->get();
        $category_dropdown = "<option value = '' selected diasabled>Select</option>";
        foreach($category as $cat){
            $category_dropdown.="<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_category = Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_category as $sub_cat){
                $category_dropdown.="<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";
            }
        }
    	return view('Admin.Product.addProduct')->with(compact('category_dropdown')); 
    }
    
    public function displayProduct()
    {
        $product=Product::all();
        return view('Admin.Product.displayProduct',compact('product'));
    }
    public function editProduct(Request $request,$id=null)
    {
        if($request->isMethod('post')){
            $product = $request->all();
                if($request->hasFile('picture'))
            {
                $file=$request->file('picture');
                $filename='picture'.time().'.'.$request->picture->extension();
                $file->move("upload/",$filename);
    
                $product=Product::find($request->id);
                $product->category_id=$request->category_id;
                $product->name=$request->product_name;
                $product->code=$request->product_code;
                $product->description=$request->product_description;
                $product->price=$request->product_price;
                $product->picture=$filename;
                $updated=$product->save();
            }
            else
            {
                $product=Product::find($request->id);
                $product->category_id=$request->category_id;
                $product->name=$request->product_name;
                $product->code=$request->product_code;
                $product->description=$request->product_description;
                $product->price=$request->product_price;
                $updated=$product->save();
            }
            if($updated){
                Alert::success('Product Successfully Updated!', 'Success Message');
                return redirect('/admin/display-product');
            }
        }
        $product=Product::find($id);
        //Category Dropdown Menu Code
        $category = Category::where(['parent_id'=>0])->get();
        $category_dropdown = "<option value = '' selected diasabled>Select</option>";
        foreach($category as $cat){
            if($cat->id==$product->category_id){
                $selected="selected";
            }else{
                $selected="";
            }
            $category_dropdown.="<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
        }
        //Code for sub categories

        $sub_category=Category::where(['parent_id'=>$cat->id])->get();
        foreach($sub_category as $sub_cat){
            if($cat->id==$product->category_id){
                $selected="selected";
            }else{
                $selected="";
            }
            $category_dropdown.="<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp".$sub_cat->name."</option>";
        }
        return view('Admin.Product.editProduct',compact('product','category_dropdown'));
    }
    public function deleteProduct($id)
    {
        $product=Product::find($id)->delete();
        if($product)
        {
        	Alert::success('Product Deleted Successfully!', 'Success Message');
            return redirect('/admin/display-product');
        }
    }
    public function updateStatus(Request $request, $id=null){
        $data= $request->all(); 
        Product::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

}
