@extends('Admin.layouts.master')
@section('title','Banners')
@section('content')

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
                                <i class="fa fa-plus"></i><a href="{{url('/admin/add-banner')}}"> Add Banner</a>
                                </button>
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
                                            <th>Name</th>
                                            <th>Sort Order</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <td>1</td>
                                            <td>Banner Name</td>
                                            <td>1</td>
                                            <td>Image</td>
                                            <td>Status</td>
                                            <td>
                                            <a href="#"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true" style="color: green"></i></a>
                                            <a href="#"><i class="fa fa-trash-o fa-2x" style="color: red"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        @endsection