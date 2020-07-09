@extends('Admin.layouts.master')
@section('title','Edit Banner')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Edit Banner</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{url('/saveBanner/edits/'.$banners->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @if(session('message'))
                <p class="alert alert-success">
                    {{session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>
                @endif

                {{csrf_field()}}
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="banner_name" name="banner_name" value="{{$banners->name}}" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Text Style</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="text_style" name="text_style" value="{{$banners->text_style}}" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Content</label></div>
                    <div class="col-12 col-md-9"><textarea name="banner_content" id="banner_content" rows="9" placeholder="Enter content" class="form-control">{{$banners->content}}</textarea></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Link</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="link" name="link" value="{{$banners->link}}" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Sort Order</label></div>
                    <div class="col-12 col-md-9"><input type="text" id="sort_order" name="sort_order" value="{{$banners->sort_order}}" class="form-control"></div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3"><label for="file-input" class=" form-control-label">Banner Image</label></div>
                    <div class="col-12 col-md-9"><img src="{{url('/upload/'.$banners->image)}}" style="height: 150px;width: 150px"><input type="file" id="image" name="image" class="form-control-file" value="{{asset($banners->image)}}"></div>
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