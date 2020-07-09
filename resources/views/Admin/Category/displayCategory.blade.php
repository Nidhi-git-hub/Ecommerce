@extends('Admin.layouts.master')
@section('title','Display Category')
@section('content')

<div id="message_success" style="display: none;" class="alert alert-sm alert-success">Status Enabled</div>
<div id="message_error" style="display: none;" class="alert alert-sm alert-danger">Status Disabled</div>
<div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i><a href="{{url('/admin/add-category')}}"><span style="color: white"> Add Category</span> </a>
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
                                            <th>Category Name</th>
                                            <th>Parent ID</th>
                                            <th>Url</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category as $categorys)
                                        <tr> 
                                            <td>{{$categorys->id}}</td>
                                            <td>{{$categorys->name}}</td>
                                            <td>{{$categorys->parent_id}}</td>
                                            <td>{{$categorys->url}}</td>
                                            <td>
                                            <input type="checkbox" class="CategoryStatus btn btn-success" rel="{{$categorys->id}}" data-toggle="toggle" data-on="Enabled" data-of="Disabled" data-onstyle="success" data-offstyle="danger"

                                            @if($categorys['status']=="1")checked @endif>
                                            <div id="myElem" style="display: none;" class="alert alert-success">Status Enabled</div>
                                            </td>
                                            <td>
                                            <a href="{{url('/saveCategory/edits/'.$categorys->id)}}"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" style="color: green"></i></a>
                                            <a href="{{url('/saveCategory/delete/'.$categorys->id)}}"><i class="fa fa-trash-o fa-2x" style="color: red"></i></a>
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