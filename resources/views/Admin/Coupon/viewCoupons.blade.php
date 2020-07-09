@extends('Admin.layouts.master')
@section('title','View Coupons')
@section('content')

<div id="message_success" style="display: none;" class="alert alert-sm alert-success">Status Enabled</div>
<div id="message_error" style="display: none;" class="alert alert-sm alert-danger">Status Disabled</div>

<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Coupon</strong>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i><a href="{{url('/admin/add-coupon')}}"><span style="color: white"> Add Coupon</span> </a>
                                </button>
                            </div>
                            @if(session('message'))
                            <p class="alert alert-success">
                            {{session('message')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </p>
                            @endif

                            @if(session('delete'))
                            <p class="alert alert-danger">
                            {{session('delete')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </p>
                            @endif
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Coupon ID</th>
                                            <th>Coupon Code</th>
                                            <th>Amount</th>
                                            <th>Amount Type</th>
                                            <th>Expiry Date</th>
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coupons as $coupon)
                                        <tr> 
                                            <td>{{$coupon->id}}</td>
                                            <td>{{$coupon->coupon_code}}</td>
                                            <td>{{$coupon->amount}}</td>
                                            <td>{{$coupon->amount_type}}</td>
                                            <td>{{$coupon->expiry_date}}</td>
                                            <td>{{$coupon->created_at}}</td>
                                            <td>
                                            <input type="checkbox" class="CouponStatus btn btn-success" rel="{{$coupon->id}}" data-toggle="toggle" data-on="Enabled" data-of="Disabled" data-onstyle="success" data-offstyle="danger"

                                            @if($coupon['status']=="1")checked @endif>
                                            <div id="myElem" style="display: none;" class="alert alert-success">Status Enabled</div>
                                            </td>
                                            <td>
                                            <a href="{{url('/admin/edit-coupon/'.$coupon->id)}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" style="color: green"></i></a>
                                            <a href="{{url('/admin/delete-coupon/'.$coupon->id)}}"><i class="fa fa-trash-o fa-2x" style="color: red"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        @endsection