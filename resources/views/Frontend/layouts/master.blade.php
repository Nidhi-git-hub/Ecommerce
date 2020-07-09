<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Grocery Store a Ecommerce Online Shopping Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Grocery Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="{{asset('frontend_assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{asset('frontend_assets/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="{{asset('frontend_assets/css/font-awesome.css')}}" rel="stylesheet" type="text/css" media="all" /> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="{{asset('frontend_assets/js/jquery-1.11.1.min.js')}}"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{asset('frontend_assets/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('frontend_assets/js/easing.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
</head>
	
<body>


@include('Frontend.layouts.header')


@yield('content')


@include('Frontend.layouts.footer')


<!-- Bootstrap Core JavaScript -->
<script src="{{asset('frontend_assets/js/bootstrap.min.js')}}"></script>
<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<script src="{{asset('frontend_assets/js/minicart.js')}}"></script>
<script>
		paypal.minicart.render();

		paypal.minicart.cart.on('checkout', function (evt) {
			var items = this.items(),
				len = items.length,
				total = 0,
				i;

			// Count the number of each item in the cart
			for (i = 0; i < len; i++) {
				total += items[i].get('quantity');
			}

			if (total < 3) {
				alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
				evt.preventDefault();
			}
		});

	</script>
	<script>
		jQuery(document).ready( function ($) {
			$("#selSize").change(function(){
				// alert ("test");
				var idSize = $(this).val();
				if(idSize==""){
					return false;
				}
				$.ajax({
					type: 'get',
					url: '/get-product-price',
					data:{idSize:idSize},
					success:function(resp){
						// alert(resp);
						var arr=resp.split('#');
						$("#getPrice").html("Price : Rs. "+arr[0]);
						$('#price').val(arr[0]);
					},error:function(){
						alert("Error");
					}
				});
			});
			$("#billtoship").click(function(){
				if(this.checked){
					$("#shippingName").val($("#billingName").val());
					$("#shippingAddress").val($("#billingAddress").val());
					$("#shippingCity").val($("#billingCity").val());
					$("#shippingState").val($("#billingState").val());
					$("#shippingCountry").val($("#billingCountry").val());
					$("#shippingPincode").val($("#billingPincode").val());
					$("#shippingMobile").val($("#billingMobile").val());
				}else{
					$("#shippingName").val('');
					$("#shippingAddress").val('');
					$("#shippingCity").val('');
					$("#shippingState").val('');
					$("#shippingCountry").val('');
					$("#shippingPincode").val('');
					$("#shippingMobile").val('');
				}
			});
		});
	</script>
</body>
</html>
