@extends('Admin.layouts.master')
@section('title','Display Product')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Data Table</strong>
                    </div>
                    @if(session('message'))
                    <p class="alert alert-success">
                    {{session('message')}}
                    </p>
                    @endif

                    @if(session('delete'))
                    <p class="alert alert-danger">
                    {{session('delete')}}
                    </p>
                    @endif

                    <div id="message_success" style="display: none;" class="alert alert-sm alert-success">Status Enabled</div>
                    <div id="message_error" style="display: none;" class="alert alert-sm alert-danger">Status Disabled</div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category ID</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Picture</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product as $products)
                                <tr> 
                                    <td>{{$products->id}}</td>
                                    <td>{{$products->name}}</td>
                                    <td>{{$products->category_id}}</td>
                                    <td>{{$products->code}}</td>
                                    <td>{{$products->description}}</td>
                                    <td>{{$products->price}}</td>
                                    <td>@php if (!empty($products->picture))
                                    {
                                    @endphp
                                    <img src="{{url('/upload/'.$products->picture)}}" style="height: 150px; width: 150px" >
                                    @php 
                                    } else {
                                    @endphp 
                                    <p>No image found</p>
                                    @php
                                    }
                                    @endphp
                                    </td>
                                    <td>
                                          <input type="checkbox" name="" class="ProductStatus btn btn-success" rel="{{$products->id}}" data-toggle="toggle" data-on="Enabled" data-of="Disabled" data-onstyle="success" data-offstyle="danger"

                                          @if($products['status']=="1")checked @endif>
                                          <div id="myElem" style="display: none;" class="alert alert-success">Status Enabled</div> 


                                          
                                          


                                       </td>
                                    <td>
                                    <a href="{{url('/saveProduct/edits/'.$products->id)}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" style="color: green"></i></a>
                                    <a href="{{url('/saveProduct/delete/'.$products->id)}}"><i class="fa fa-trash-o fa-2x" style="color: red"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection