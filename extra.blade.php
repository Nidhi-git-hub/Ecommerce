 <div id="message_success" style="display: none;" class="alert alert-success">Status Enabled</div>
                            <div id="message_error" style="display: none;" class="alert alert-success">Status Disabled</div>
<input type="checkbox" class="ProductStatus btn btn-success" rel="{{$products->id}}" 
                                                data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                             @if($products['status']=="1") checked @endif>
                                             <div id="myElem" style="display: none;" class="alert alert-success">Status Enabled</div>



                                             public function updateStatus(Request $request,$id=null){
        $data = $request->all();
        Product::where('id',$data['id'])->update(['status'=>$data['status']]);
    }

    Route::post('/admin/update-product-status','ProductController@updateStatus');




 




 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
 <script>
        $(document).ready( function () {
        $('#table_id').DataTable();
        $(".ProductStatus").change(function(){
            var id = $(this).attr('rel');
            if($(this).prop("checked")=="true"){
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    type:'post',
                    url:'/admin/update-product-status',
                    data: {status:'1',id:id},
                    success:function(data){
                        $("#message_success").show();
                        setTimeout(function(){ $("#message_success").fadeout('slow');},2000);
                    },error:function(){
                        alert("Error");
                    }
                })
            }else{
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    type:'post',
                    url:'/admin/update-product-status',
                    data: {status:'0',id:id},
                    success:function(resp){
                        $("#message_error").show();
                        setTimeout(function(){ $("#message_error").fadeout('slow');},2000);
                    },error:function(){
                        alert("Error");
                    }
                })
            }
        });
        });    
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.js"></script>    

    <script type="text/javascript">
           $(document).ready( function () {
    $('#table_id').DataTable({
      "paging":false,
    });

    //update product status
    $(".ProductStatus").change(function(){
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
      </script>



      $table->integer('product_id');
            $table->string('sku');
            $table->string('size');
            $table->double('price',8,2);
            $table->integer('stock');

            public function addAttributes(Request $request,$id=null){
        $productDetails= Product::where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            foreach($data['sku'] as $key=>$val){
                if(!empty($val)){
                    //Prevent Duplicate SKU Record
                    $attrCountSKU = ProductAttribute::where('sku',$val)->count();
                    if($attrCountSKU>0){
                        return redirect('/admin/add-attributes/'.$id)->with('flash_message_error','SKU already exist please select another sku');
                    }
                    //Prevent Duplicate Size Record
                    $attrCountSizes = ProductAttribute::where(['product_id'=>$id,'size'=>$data['size'],[$key]])->count();
                    if($attrCountSizes>0){
                        return redirect('/admin/add-attributes/'.$id)->with('flash_message_error',''.$data['size'][$key],'Size already exist please select another size');
                    }
                    $attribute = new ProductAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->price=$request->price;
                    $attribute->size=$request->size;
                    $attribute->stock=$request->stock;
                    $attribute->save();
                    if($attribute)
                    {
                        Alert::success('Attribute Successfully Added!', 'Success Message');
                        return redirect('/admin/add-attributes/',$id);
                    } 
                }
            }
        }
        return view('Admin.Product.addAttributes')->with(compact('productDetails'));
    }

    <div class="col-lg-6 offset-lg-3" id="slider">
            <div id="myCarousel" class="carousel slide">
                <div class="carousel-inner">
                    <div class="active item carousel-item" data-slide-number="0">
                        <img src="http://placehold.it/1200x480&amp;text=one" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="1">
                        <img src="http://placehold.it/1200x480/888/FFF" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="2">
                        <img src="http://placehold.it/1200x480&amp;text=three" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="3">
                        <img src="http://placehold.it/1200x480&amp;text=four" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="4">
                        <img src="http://placehold.it/1200x480&amp;text=five" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="5">
                        <img src="http://placehold.it/1200x480&amp;text=six" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="6">
                        <img src="http://placehold.it/1200x480&amp;text=seven" class="img-fluid">
                    </div>
                    <div class="item carousel-item" data-slide-number="7">
                        <img src="http://placehold.it/1200x480&amp;text=eight" class="img-fluid">
                    </div>

                    <a class="carousel-control left pt-3" href="#myCarousel" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="carousel-control right pt-3" href="#myCarousel" data-slide="next"><i class="fa fa-chevron-right"></i></a>

                </div>


                <ul class="carousel-indicators list-inline">
                    <li class="list-inline-item active">
                        <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=one" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-1" data-slide-to="1" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=two" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-2" data-slide-to="2" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=three" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-3" data-slide-to="3" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=four" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-4" data-slide-to="4" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=five" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-5" data-slide-to="5" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=six" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-6" data-slide-to="6" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=seven" class="img-fluid">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a id="carousel-selector-7" data-slide-to="7" data-target="#myCarousel">
                            <img src="http://placehold.it/80x60&amp;text=eight" class="img-fluid">
                        </a>
                    </li>
                </ul>
        </div>
    </div>