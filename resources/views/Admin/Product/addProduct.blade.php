@extends('Admin.layouts.master')
@section('title','Add Product')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Products</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{url('/admin/add-product')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @if(session('message'))
                <p class="alert alert-success">
                    {{session('message')}}
                </p>
                @endif

                {{csrf_field()}}
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
                    <div class="col-12 col-md-9"><input type="text" id="product_name" name="product_name" placeholder="Enter Product Name" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Code</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="product_code" name="product_code" placeholder="Enter Product Code" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Product Description</label></div>
                    <div class="col-12 col-md-9"><textarea name="product_description" id="product_description" rows="9" placeholder="Enter product description" class="form-control"></textarea></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Price</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="product_price" name="product_price" placeholder="Enter Product Price" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Picture Upload</label></div>
                    <div class="col-12 col-md-9"><input type="file" id="picture" name="picture" class="form-control-file"></div>
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