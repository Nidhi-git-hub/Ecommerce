<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Image;
use App\Product;
use App\Category;
use App\Banner;
use App\ProductAttribute;
use App\ProductImage;
use DB;
use Session;
use App\Coupon;
use Auth;
use App\User;
use App\Country;
use App\DeliveryAddress;

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
    public function updateStatus(Request $request,$id=null){
        $data= $request->all(); 
        Product::where('id',$data['id'])->update(['status'=>$data['status']]);
    }
    public function products($id=null){
        $productDetails = Product::with('attributes')->where('id',$id)->first();
        $productImage = ProductImage::where('product_id',$id)->get();
        $category= Category::with('category')->where(['parent_id'=>0])->get();
        $featuredProducts = Product::where(['featured_products'=>1])->get();
        return view('Frontend.productDetails')->with(compact('category','productDetails','productImage','featuredProducts'));
    }
    public function addAttributes(Request $request,$id=null){
        $productDetails= Product::with('attributes')->where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            foreach($data['sku'] as $key => $val){
                if(!empty($val)){
                    //Prevent Duplicate SKU Record
                    $attrCountSKU = ProductAttribute::where('sku',$val)->count();
                    if($attrCountSKU>0){
                        return redirect('/admin/add-attributes/'.$id)->with('message','SKU already exist please select another sku');
                    }
                    //Prevent Duplicate Size Record
                    $attrCountSizes = ProductAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSizes>0){
                        return redirect('/admin/add-attributes/'.$id)->with('message',''.$data['size'][$key].'Size already exist please select another size');
                    }
                    $attribute = new ProductAttribute;
                    $attribute->product_id =$id;
                    $attribute->sku = $val;
                    $attribute->size=$data['size'][$key];
                    $attribute->price=$data['price'][$key];
                    $attribute->stock=$data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect('/admin/add-attributes/'.$id)->with('message','Product attribute added successfully');
        }
        return view('Admin.Product.addAttributes')->with(compact('productDetails'));
    }
    public function deleteAttribute($id=null){
        ProductAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('delete','Product Attribute is Deleted.');
    }
    public function editAttribute(Request $request,$id=null){
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach($data['attr'] as $key=>$attr){
                ProductAttribute::where(['id'=>$data['attr'][$key]])->update(['sku'=>$data['sku'][$key],'size'=>$data['size'][$key],'price'=>$data['price'][$key],'stock'=>$data['stock'][$key],]);
            }
            return redirect()->back()->with('message','Products Attributes Updated Successfully!!');
        }
    }
    public function addImages(Request $request,$id=null){
        $productDetails = Product::where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->hasFile('image')){
                $files=$request->file('image');
                foreach ($files as $file) {
                    $image= new ProductImage;
                    $extension= $file->getClientOriginalExtension();
                    $filename= rand(111, 99999).'.'.$extension;
                    $image_path= 'upload/'.$filename;
                    Image::make($file)->save($image_path);
                    $image->image=$filename;
                    $image->product_id= $data['product_id'];
                    $image->save();
                }
            }
            return redirect('/admin/add-images/'.$id)->with('message','Image has been Updated Successfully!!');
        }
        $productImages = ProductImage::where(['product_id'=>$id])->get();
        return view('Admin.Product.addImages')->with(compact('productDetails','productImages'));
    }
     public function deleteAltImage($id=null){
        $productImage= ProductImage::where(['id'=>$id])->first();

        $image_path="upload/";
        if(file_exists($image_path.$productImage->image)){
            unlink($image_path.$productImage->image);
        }
        ProductImage::where(['id'=>$id])->delete();
        Alert::success('Deleted Successfully!!', 'Success Message');
        return redirect()->back();
    }
    public function updateFeatured(Request $request,$id=null){
        $data= $request->all(); 
        Product::where('id',$data['id'])->update(['featured_products'=>$data['status']]);
    }
    public function getPrice(Request $request){
        $data= $request->all();
        // echo "<pre>";print_r($data);die;
        $proArr= explode("-",$data['idSize']);
        $proAttr= ProductAttribute::where(['product_id'=>$proArr[0], 'size'=>$proArr[1]])->first();
        echo $proAttr->price;
    }
    public function addtocart(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        if(empty($data['user_email'])){
            $data['user_email']='';
        }
        $session_id = Session::get('session_id');
        if(empty($session_id)){
        $session_id = str_random(40);
        Session::put('session_id',$session_id);
        }
        $sizeArr = explode('-', $data['size']);
        $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],'size'=>$sizeArr[1],'price'=>$data['price'],'session_id'=>$session_id])->count();
        if ($countProducts>0) {
            return redirect()->back()->with('delete','Product already exists in cart!!');
        }else{
            DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'], 'product_code'=>$data['product_code'],'size'=>$sizeArr[1],'price'=>$data['price'],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
        }
        return redirect('/cart')->with('message','Product has been added in cart');
    }
    public function cart(Request $request){
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        foreach ($userCart as $key => $products) {
            $productDetails = Product::where(['id'=>$products->product_id])->first();
            $userCart[$key]->image = $productDetails->picture;
        }
        return view('Frontend.Products.cart')->with(compact('userCart'));
    }
    public function deleteCartProduct($id=null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect('/cart')->with('delete','Product has been deleted!!');
    }
    public function updateCartQuantity($id=null,$quantity=null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
        return redirect('/cart')->with('message','Product quantity has been updated successfully');
    }
    public function applycoupon(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
            if($couponCount == 0){
                return redirect()->back()->with('delete','Coupon code does not exist');
            }else{
                // echo "string";die;
                $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();
                //Coupon code status
                if($couponDetails->status == 0){
                    return redirect()->back()->with('delete','Coupon code is not active');
                }
                //Check coupon expiry date
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if($expiry_date < $current_date){
                    return redirect()->back()->with('delete','Coupon code is expired');
                }
                //Coupon is ready for discount
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
                $total_amount = 0;
                foreach ($userCart as $item) {
                    $total_amount = $total_amount + ($item->price*$item->quantity);
                }
                //Check if coupon amount is fixed or percentage
                if($couponDetails->amount_type=="Fixed"){
                    $couponAmount = $couponDetails->amount;
                }else{
                    $couponAmount = $total_amount*($couponDetails->amount/100);
                }
                //Add coupon code in session
                Session::put('CouponAmount',$couponAmount);
                Session::put('CouponCode',$data['coupon_code']);
                return redirect()->back()->with('message','Coupon Code is successfully applied.You are availing discount!!');

            }
        }
    }
    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $userDetails = User::find($user_id);
        $countries = Country::get();
        //Check if shipping address exists
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount > 0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            //Update User Details
            User:: where('id',$user_id)->update(['name'=>$data['billingName'],'address'=>$data['billingAddress'],'city'=>$data['billingCity'],'state'=>$data['billingState'],'country'=>$data['billingCountry'],'pincode'=>$data['billingPincode'],'mobile'=>$data['billingMobile']]);
            if($shippingCount > 0){
                //Update Shipping Address
                DeliveryAddress:: where('user_id',$user_id)->update(['name'=>$data['shippingName'],'address'=>$data['shippingAddress'],'city'=>$data['shippingCity'],'state'=>$data['shippingState'],'country'=>$data['shippingCountry'],'pincode'=>$data['shippingPincode'],'mobile'=>$data['shippingMobile']]);
            }else{
                //New Shipping Address
                $shipping = new DeliveryAddress;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shippingName'];
                $shipping->address = $data['shippingAddress'];
                $shipping->city = $data['shippingCity'];
                $shipping->state = $data['shippingState'];
                $shipping->country = $data['shippingCountry'];
                $shipping->pincode = $data['shippingPincode'];
                $shipping->mobile = $data['shippingMobile'];
                $shipping->save();
            }
            echo "Redirect To Order Review Page";die;
        }
        return view('Frontend.Products.checkout')->with(compact('userDetails','countries','shippingDetails'));
    }

}
