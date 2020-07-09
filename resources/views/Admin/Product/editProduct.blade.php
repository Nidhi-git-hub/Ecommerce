@extends('Admin.layouts.master')
@section('title','Edit Product')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Edit Product</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{url('/saveProduct/edits/{id}')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @if(session('message'))
                <p class="alert alert-success">
                    {{session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>
                @endif

                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$product->id}}">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Under Category</label></div>
                    <div class="col-12 col-md-9">
                        <select name="category_id" id="category_id" class="form-control">
                            <?php echo $category_dropdown ?>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Name</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="product_name" name="product_name" class="form-control" value="{{$product->name}}"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Code</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="product_code" name="product_code" class="form-control" value="{{$product->code}}"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Product Description</label></div>
                    <div class="col-12 col-md-9"><textarea name="product_description" id="product_description" rows="9" class="form-control">{{$product->description}}</textarea></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Price</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="product_price" name="product_price" class="form-control" value="{{$product->price}}"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Picture Upload</label></div>
                    <div class="col-12 col-md-9"><img src="{{url('/upload/'.$product->picture)}}" style="height: 150px;width: 150px"><input type="file" id="picture" name="picture" class="form-control-file" value="{{asset($product->picture)}}"></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                </div>
            </form>
        </div>
                                                    
    </div>
@endsection