@extends('admin.layout')
@section('page_title', 'Manage Category')
@section('category_select', 'active')
@section('admin.content')
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Add Category</h2>
            <a href="{{url('admin/category')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="zmdi zmdi-arrow-back"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Add Category</div>
            <div class="card-body">
                <form action="{{route('category.manage_category_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="category_name" class="control-label mb-1">Category Name</label>
                        <input id="category_name" value="{{$category_name}}" name="category_name" type="text" class="form-control" required>
                        @error('category_name')
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_slug" class="control-label mb-1">Category Slug</label>
                        <input id="category_slug" value="{{$category_slug}}" name="category_slug" type="text" class="form-control" required>
                        @error('category_slug')
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_desc" class="control-label mb-1">Description</label>
                        <textarea id="category_desc" name="category_desc" class="form-control">{{$category_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_image" class="control-label mb-1">Category Image</label>
                        <input id="category_image" name="category_image" type="file" class="form-control">
                    </div>
                    <div>
                        <button id="category-button" type="submit" class="btn btn-lg btn-info btn-block">Save</button>
                    </div>
                    <input type="hidden" name="id" value="{{$id}}">
                </form>
            </div>
        </div>
    </div>
</div>


@endsection