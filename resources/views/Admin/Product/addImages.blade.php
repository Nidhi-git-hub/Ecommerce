@extends('Admin.layouts.master')
@section('title','Add Images')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Images</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{url('/admin/add-images/'.$productDetails->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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

                {{csrf_field()}}
                <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Name</label></div>
                    {{$productDetails->name}}
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Code</label></div>
                    {{$productDetails->code}}
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Images</label></div>
                    <input type="file" name="image[]" multiple="multiple">
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                </div>
            </form>
        </div>                                      
    </div>
    <div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                    </div>

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <form enctype="multipart/form-data"  method="POST">
                                {{csrf_field()}}
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product ID</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productImages as $productImage)
                                <tr>
                                    <td>{{$productImage->id}}</td>
                                    <td>{{$productImage->product_id}}</td>
                                    <td><img src="{{url('upload/'.$productImage->image)}}" style="width: 80px"></td>
                                    <td class="center">
                                        <div class="btn-group">
                                            
                                            <a href="{{url('/admin/delete-alt-image/'.$productImage->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-x"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection