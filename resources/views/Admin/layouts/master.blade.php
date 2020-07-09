<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - Grocery Shop</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{asset('backend_assets/apple-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('backend_assets/favicon.ico')}}">


    <link rel="stylesheet" href="{{asset('backend_assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend_assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend_assets/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backend_assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend_assets/vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('backend_assets/assets/css/style.css')}}">

    <link href="{{asset('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800')}}" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    

</head>

<body>

@include('Admin.layouts.sidebar')

@include('Admin.layouts.header')


@yield('content')



   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  jQuery( function($) {
    $( "#datepicker" ).datepicker({
      minDate:0,
      dateFormat:'yy-mm-dd',
    });
  } );
  </script>
  </script>
    <script src="{{asset('backend_assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('backend_assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('backend_assets/assets/js/main.js')}}"></script>

    <!-- Gmaps -->
    
    <script>
          jQuery(document).ready( function ($) {

        //update product status
        $(".ProductStatus").change(function () {
          var id= $(this).attr('rel');
          if($(this).prop("checked")==true){
            $.ajax({
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-product-status',
                data: {status:'1', id:id},
                success: function(data){
                  $("#message_success").show();
                  setTimeout(function(){ $("#message_success").fadeOut('slow');}, 2000);
                },error:function(){
                  alert("Error");
                }
            });
          }else{
            $.ajax({
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-product-status',
                data: {status:'0', id:id},
                success: function(data){
                  $("#message_error").show();
                  setTimeout(function(){ $("#message_error").fadeOut('slow');}, 2000);
                },error:function(){
                  alert("Error");
                }
            });

          }
    });
        //update category status
        $(".CategoryStatus").change(function () {
          var id= $(this).attr('rel');
          if($(this).prop("checked")==true){
            $.ajax({
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-category-status',
                data: {status:'1', id:id},
                success: function(data){
                  $("#message_success").show();
                  setTimeout(function(){ $("#message_success").fadeOut('slow');}, 2000);
                },error:function(){
                  alert("Error");
                }
            });
          }else{
            $.ajax({
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-category-status',
                data: {status:'0', id:id},
                success: function(data){
                  $("#message_error").show();
                  setTimeout(function(){ $("#message_error").fadeOut('slow');}, 2000);
                },error:function(){
                  alert("Error");
                }
            });

          }
    });
        
        //update featured product status
        $(".FeaturedStatus").change(function () {
          var id= $(this).attr('rel');
          if($(this).prop("checked")==true){
            $.ajax({
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-featured-product-status',
                data: {status:'1', id:id},
                success: function(data){
                  $("#message_success").show();
                  setTimeout(function(){ $("#message_success").fadeOut('slow');}, 2000);
                },error:function(){
                  alert("Error");
                }
            });
          }else{
            $.ajax({
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-featured-product-status',
                data: {status:'0', id:id},
                success: function(data){
                  $("#message_error").show();
                  setTimeout(function(){ $("#message_error").fadeOut('slow');}, 2000);
                },error:function(){
                  alert("Error");
                }
            });

          }
    });
        //update banner status
        $(".BannerStatus").change(function () {
          var id= $(this).attr('rel');
          if($(this).prop("checked")==true){
            $.ajax({
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-banner-status',
                data: {status:'1', id:id},
                success: function(data){
                  $("#message_success").show();
                  setTimeout(function(){ $("#message_success").fadeOut('slow');}, 2000);
                },error:function(){
                  alert("Error");
                }
            });
          }else{
            $.ajax({
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-banner-status',
                data: {status:'0', id:id},
                success: function(data){
                  $("#message_error").show();
                  setTimeout(function(){ $("#message_error").fadeOut('slow');}, 2000);
                },error:function(){
                  alert("Error");
                }
            });

          }
    });
        //update coupon status
        $(".CouponStatus").change(function () {
          var id= $(this).attr('rel');
          if($(this).prop("checked")==true){
            $.ajax({
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-coupon-status',
                data: {status:'1', id:id},
                success: function(data){
                  $("#message_success").show();
                  setTimeout(function(){ $("#message_success").fadeOut('slow');}, 2000);
                },error:function(){
                  alert("Error");
                }
            });
          }else{
            $.ajax({
                headers:{
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/update-coupon-status',
                data: {status:'0', id:id},
                success: function(data){
                  $("#message_error").show();
                  setTimeout(function(){ $("#message_error").fadeOut('slow');}, 2000);
                },error:function(){
                  alert("Error");
                }
            });

          }
    });
        //Add Remove fields Dynamically
        jQuery(document).ready( function ($) {
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="display: flex;"><input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width: 120px;margin-right: 5px;margin-top:5px;"><input type="text" name="size[]" id="size" placeholder="SIZE" class="form-control" style="width: 120px;margin-right: 5px;margin-top:5px;"><input type="text" name="price[]" id="price" placeholder="PRICE" class="form-control" style="width: 120px;margin-right: 5px;margin-top:5px;"><input type="text" name="stock[]" id="stock" placeholder="STOCK" class="form-control" style="width: 120px;margin-right: 5px;margin-top:5px;"><a href="javascript:void(0);" class="remove_button">Remove</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
    });  
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.js"></script>
    @include('sweetalert::alert')
</body>

</html>
