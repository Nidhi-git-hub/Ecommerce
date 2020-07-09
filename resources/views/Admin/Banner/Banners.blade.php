@extends('Admin.layouts.master')
@section('title','Banners')
@section('content')

<div id="message_success" style="display: none;" class="alert alert-sm alert-success">Status Enabled</div>
<div id="message_error" style="display: none;" class="alert alert-sm alert-danger">Status Disabled</div>

<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Banners</strong>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i><a href="{{url('/admin/add-banner')}}"><span style="color: white"> Add Banner</span> </a>
                                </button>
                            </div>
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
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Sort Order</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($banner as $banners)
                                        <tr> 
                                            <td>{{$banners->id}}</td>
                                            <td>{{$banners->name}}</td>
                                            <td>{{$banners->sort_order}}</td>
                                            <td>@php if (!empty($banners->image))
                                    {
                                    @endphp
                                    <img src="{{url('/upload/'.$banners->image)}}" style="height: 150px; width: 150px" >
                                    @php 
                                    } else {
                                    @endphp 
                                    <p>No image found</p>
                                    @php
                                    }
                                    @endphp</td>
                                            <td>
                                    <input type="checkbox" class="BannerStatus btn btn-success" rel="{{$banners->id}}" data-toggle="toggle" data-on="Enabled" data-of="Disabled" data-onstyle="success" data-offstyle="danger"

                                    @if($banners['status']=="1")checked @endif>
                                    <div id="myElem" style="display: none;" class="alert alert-success">Status Enabled</div>
                                       </td>
                                            <td>
                                            <a href="{{url('/saveBanner/edits/'.$banners->id)}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" style="color: green"></i></a>
                                            <a href="{{url('/saveBanner/delete/'.$banners->id)}}"><i class="fa fa-trash-o fa-2x" style="color: red"></i></a>
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