@extends('Frontend.layouts.master')
@section('content')
<!-- //header -->
<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="{{URL('/')}}">Home</a><span>|</span></li>
				<li>Checkout</li>
			</ul>
		</div>
	</div>
<!-- //products-breadcrumb -->
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
<!-- banner -->
	<div class="banner">
<!-- about -->
		<div class="privacy about">
			<h3>Chec<span>kout</span></h3>
			
	      <div class="checkout-right">
					<h4>Your shopping cart contains: </h4>
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>SL No.</th>	
							<th>Product</th>
							<th>Quantity</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Remove</th>
						</tr>
					</thead>
					<tbody>
						<?php $total_amount = 0; ?>
						@foreach($userCart as $cart)
						<tr class="rem1">
						<td class="invert">{{$cart->id}}</td>
						<td class="invert-image"><a href="single.html">
							@php if (!empty($cart->image))
                                    {
                                    @endphp
							<img src="{{url('/upload/'.$cart->image)}}" alt=" " class="img-responsive">
									@php 
                                    } else {
                                    @endphp 
                                    <p>No image found</p>
                                    @php
                                    }
                                    @endphp</a></td>
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">
								@if($cart->quantity>1)                           
									<a href="{{url('/cart/update-quantity/'.$cart->id).'/-1'}}"><div class="entry value-minus">&nbsp;</div></a>
									@endif
									<div class="entry value"><span>{{$cart->quantity}}</span></div>
									<a href="{{url('/cart/update-quantity/'.$cart->id).'/1'}}"><div class="entry value-plus active">&nbsp;</div></a>
								</div>
							</div>
						</td>
						<td class="invert">{{$cart->product_name}}
						<p>{{$cart->product_code}} | {{$cart->size}}</p></td>
						
						
						<td class="invert" value="{{$cart->price}}">Rs. {{$cart->price*$cart->quantity}}
							<p>Per Product : {{$cart->price}}</p></td>
						<td class="invert">
							<div class="rem">
								<a href="{{url('/cart/delete-product/'.$cart->id)}}"><div class="close1"></div></a>
							</div>
						</td>
					</tr>
					<?php $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>
					@endforeach

				</tbody></table>
			</div>
			<div class="checkout-left">	
				<div class="col-md-4 checkout-left-basket">
					<h4>Continue to basket</h4>
					<ul>
						@if(!empty(Session::get('CouponAmount')))
						<li>Sub Total <i>-</i> <span>Rs. <?php echo $total_amount; ?> </span></li>
						<li>Coupon Discount<i>-</i> <span>Rs. <?php echo Session::get('CouponAmount'); ?></span></li>
						<li>Total <i>-</i> <span>Rs. <?php echo $total_amount - Session::get('CouponAmount'); ?></span></li>
						@else
						<li>Grand Total <i>-</i> <span>Rs. <?php echo $total_amount; ?></span></li>
						@endif
					</ul>
				</div>
				<div class="col-md-4 checkout-left-basket">
					<h4>Apply Coupon</h4>
					<ul>
						<form action="{{url('/cart/apply-coupon')}}" method="post">{{csrf_field()}}
						<div class="row form-group">
                            <div class="col-12 col-md-6"><input type="text" id="coupon_code" name="coupon_code" placeholder="Coupon code" class="form-control"></div>
                            <div class="col col-md-6">
                            	<button type="submit" class="btn btn-primary btn-sm">
                                	Apply Coupon
                            	</button>
                        	</div>
                        </div>
                        </form>
					</ul>
				</div>
				<div class="col-md-8 address_form_agile">
					<div class="checkout-right-basket">
				        <a href="{{url('/checkout')}}">Checkout <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>
			      	</div>
				</div>
				<div class="clearfix"> </div>
			</div>
<!-- //about -->
		</div>
		<div class="clearfix"></div>
	</div>
<!-- //banner -->
@endsection