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