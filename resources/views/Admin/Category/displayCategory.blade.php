@extends('Admin.layouts.master')
@section('title','Display Category')
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
                                            <td>Status</td>
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