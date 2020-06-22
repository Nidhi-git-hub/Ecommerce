@extends('Admin.layouts.master')
@section('title','Add Category')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Add Category</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{url('/admin/add-category')}}" method="POST" class="form-horizontal">
                @if(session('message'))
                <p class="alert alert-success">
                    {{session('message')}}
                </p>
                @endif

                {{csrf_field()}}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Category Name</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="category_name" name="category_name" placeholder="Enter Category Name" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="select" class=" form-control-label">Parent Category</label></div>
                    <div class="col-12 col-md-9">
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="0">Parent Category</option>
                            @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Category Url</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="category_url" name="category_url" placeholder="url" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Category Description</label></div>
                    <div class="col-12 col-md-9"><textarea name="category_description" id="category_description" rows="9" placeholder="Enter category description" class="form-control"></textarea></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Add Category
                    </button>
                </div>
            </form>
        </div>
                                                    
    </div>
@endsection