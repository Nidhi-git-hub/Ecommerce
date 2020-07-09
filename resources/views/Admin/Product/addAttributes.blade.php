@extends('Admin.layouts.master')
@section('title','Product Attributes')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Product Attributes</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{url('/admin/add-attributes/'.$productDetails->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Name</label></div>
                    {{$productDetails->name}}
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Product Code</label></div>
                    {{$productDetails->code}}
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                    <div class="field_wrapper">
                        <div style="display: flex;">
                            <input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control" style="width: 120px;margin-right: 5px;">
                            <input type="text" name="size[]" id="size" placeholder="SIZE" class="form-control" style="width: 120px;margin-right: 5px;">
                            <input type="text" name="price[]" id="price" placeholder="PRICE" class="form-control" style="width: 120px;margin-right: 5px;">
                            <input type="text" name="stock[]" id="stock" placeholder="STOCK" class="form-control" style="width: 120px;margin-right: 5px;">
                            <a href="javascript:void(0);" class="add_button" title="Add Field">Add</a>
                        </div>
                    </div>
                    </div>
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
                            <form enctype="multipart/form-data" action="{{url('/admin/edit-attribute/'.$productDetails->id)}}" method="POST">
                                {{csrf_field()}}
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>SKU</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productDetails['attributes'] as $attribute)
                                <tr>
                                    <td  style="display: none;"><input type="hidden" name="attr[]" value="{{$attribute->id}}">{{$attribute->id}}</td>
                                    <td>{{$attribute->id}}</td>
                                    <td><input type="text" name="sku[]" value="{{$attribute->sku}}" style="text-align: center;"></td>
                                    <td><input type="text" name="size[]" value="{{$attribute->size}}" style="text-align: center;"></td>
                                    <td><input type="text" name="price[]" value="{{$attribute->price}}" style="text-align: center;"></td>
                                    <td><input type="text" name="stock[]" value="{{$attribute->stock}}" style="text-align: center;"></td>
                                    <td class="center">
                                        <div class="btn-group">
                                    <input type="submit" value="update" class="btn btn-success" style="height: 33px;padding-top: 4px">
                                    <a href="{{url('/admin/delete-attribute/'.$attribute->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-x"></i></a>
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