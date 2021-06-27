@extends('admin.layout')
@section('page_title', 'Manage Size')
@section('size_select', 'active')
@section('admin.content')

<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Add Size</h2>
            <a href="{{url('admin/size')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="zmdi zmdi-arrow-back"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Add Size</div>
            <div class="card-body">
                <form action="{{route('size.manage_size_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="size" class="control-label mb-1">Title</label>
                        <input id="size" value="{{$size}}" name="size" type="text" class="form-control" required>
                        @error('size')
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div>
                        <button id="coupon-button" type="submit" class="btn btn-lg btn-info btn-block">Save</button>
                    </div>
                    <input type="hidden" name="id" value="{{$id}}">
                </form>
            </div>
        </div>
    </div>
</div>


@endsection