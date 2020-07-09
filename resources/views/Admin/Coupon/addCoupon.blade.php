@extends('Admin.layouts.master')
@section('title','Add Coupon')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Coupon</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{url('/admin/add-coupon')}}" method="POST" enctype="multipart/form-data" class="form-horizontal"  name="add-coupon" id="add-coupon">
                @if(session('message'))
                <p class="alert alert-success">
                    {{session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>
                @endif

                {{csrf_field()}}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Coupon Code</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="coupon_code" name="coupon_code" placeholder="Enter Coupon Code" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Amount</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="coupon_amount" name="coupon_amount" placeholder="Enter Amount" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Amount Type</label></div>
                    <div class="col-12 col-md-9">
                        <select name="amount_type" id="amount_type" class="form-control">
                            <option>Select</option>
                            <option value="Percentage">Percentage</option>
                            <option value="Fixed">Fixed</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Expiry Date</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="datepicker" name="expiry_date" class="form-control"></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Add Coupon
                    </button>
                </div>
            </form>
        </div>
                                                    
    </div>
@endsection