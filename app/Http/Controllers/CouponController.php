<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Coupon;

class CouponController extends Controller
{
    public function addCoupon(Request $request){
    	if($request->isMethod('post')){
            $data = $request->all();

            $coupon= new Coupon;
            $coupon->coupon_code=$request->coupon_code;
            $coupon->amount=$request->coupon_amount;
            $coupon->amount_type=$request->amount_type;
            $coupon->expiry_date=$request->expiry_date;
            $coupon->save();
            if($coupon)
            {
                Alert::success('Coupon Successfully Added!', 'Success Message');
                return redirect('/admin/view-coupons');
            }   
        }
    	return view('Admin.Coupon.addCoupon');
    }
    public function viewCoupons(){
    	$coupons = Coupon::get();
    	return view('Admin.Coupon.viewCoupons')->with(compact('coupons'));
    }
    public function updateStatus(Request $request,$id=null){
        $data= $request->all(); 
        Coupon::where('id',$data['id'])->update(['status'=>$data['status']]);
    }
    public function editCoupon(Request $request,$id=null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $coupon=Coupon::find($request->id);
            $coupon->coupon_code=$request->coupon_code;
            $coupon->amount=$request->coupon_amount;
            $coupon->amount_type=$request->amount_type;
            $coupon->expiry_date=$request->expiry_date;
            $updated=$coupon->save();

            if($updated){
                Alert::success('Coupon Successfully Updated!', 'Success Message');
                return redirect('/admin/view-coupons');
            }
        }
        $couponDetails = Coupon::find($id);
        return view('Admin.Coupon.editCoupon')->with(compact('couponDetails'));
    }
    public function deleteCoupon($id=null)
    {
        Coupon::where(['id'=>$id])->delete();
        Alert::success('Deleted!', 'Success Message');
        return redirect()->back();
    }
}
