@extends('Frontend.layouts.master')
@section('content')

<!-- products-breadcrumb -->
	<div class="products-breadcrumb">
		<div class="container">
			<ul>
				<li><i class="fa fa-home" aria-hidden="true"></i><a href="{{URL('/')}}">Home</a><span>|</span></li>
				<li>Sign In & Sign Up</li>
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
<!-- login -->
<div class="col-md-6">
	<div class="w3_login">
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="toggle">
				  </div>
				  <div class="form">
					<h2>Bill To</h2>
					<form action="{{url('/checkout')}}" method="post">{{csrf_field()}}
					  <input type="text" name="billingName" id="billingName" value="{{$userDetails->name}}" required=" ">
					  <input type="text" name="billingAddress" id="billingAddress" value="{{$userDetails->address}}" required=" ">
					  <input type="text" name="billingCity" id="billingCity" value="{{$userDetails->city}}" required=" ">
					  <input type="text" name="billingState" id="billingState" value="{{$userDetails->state}}" required=" ">
					  <select name="billingCountry" id="billingCountry" style="outline: none;display: block; width: 100%; border: 1px solid #d9d9d9; margin: 0 0 20px; padding: 10px 15px; box-sizing: border-box; font-wieght: 400; -webkit-transition: 0.3s ease; transition: 0.3s ease; font-size:14px;">
  					  	<option value="1">Select Country</option>
  					  	@foreach($countries as $country)
  					  	<option value="{{$country->country_name}}" @if(!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
  					  	@endforeach
					  </select>
					  <input type="text" name="billingPincode" id="billingPincode" value="{{$userDetails->pincode}}" required=" ">
					  <input type="text" name="billingMobile" id="billingMobile" value="{{$userDetails->mobile}}" required=" ">
					  <div class="form-check">
    					<input type="checkbox" class="form-check-input" id="billtoship">
    					Shipping Address Same as Billing Address
  					  </div>
				  </div>
				</div>
			</div>
	</div>
</div>
<div class="col-md-6">
	<div class="w3_login">
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="toggle">
				  </div>
				  <div class="form">
					<h2>Ship To</h2>
					  <input type="text" name="shippingName" id="shippingName" value="{{$shippingDetails->name}}" required=" ">
					  <input type="text" name="shippingAddress" id="shippingAddress" value="{{$shippingDetails->address}}" required=" ">
					  <input type="text" name="shippingCity" id="shippingCity" value="{{$shippingDetails->city}}" required=" ">
					  <input type="text" name="shippingState" id="shippingState" value="{{$shippingDetails->state}}" required=" ">
					  <select name="shippingCountry" id="shippingCountry" style="outline: none;display: block; width: 100%; border: 1px solid #d9d9d9; margin: 0 0 20px; padding: 10px 15px; box-sizing: border-box; font-wieght: 400; -webkit-transition: 0.3s ease; transition: 0.3s ease; font-size:14px;">
  					  	<option value="">Shipping Country</option>
  					  	@foreach($countries as $country)
  					  	<option value="{{$country->country_name}}" @if(!empty($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif>{{$country->country_name}}</option>
  					  	@endforeach
					  </select>
					  <input type="text" name="shippingPincode" id="shippingPincode" value="{{$shippingDetails->pincode}}" required=" ">
					  <input type="text" name="shippingMobile" id="shippingMobile" value="{{$shippingDetails->mobile}}" required=" ">
					  <input type="submit" value="Checkout" id="submit">
					</form>
				  </div>
				</div>
			</div>
	</div>

</div>
<!-- //login -->
</div>
		<div class="clearfix"></div>
<!-- //banner -->

@endsection