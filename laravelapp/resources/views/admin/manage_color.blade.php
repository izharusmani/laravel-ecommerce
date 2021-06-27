@extends('admin.layout')
@section('page_title', 'Manage Color')
@section('color_select', 'active')
@section('admin.content')

<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Add Color</h2>
            <a href="{{url('admin/color')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="zmdi zmdi-arrow-back"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Add Color</div>
            <div class="card-body">
                <form action="{{route('color.manage_color_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="color" class="control-label mb-1">Title</label>
                        <input id="color" value="{{$color}}" name="color" type="text" class="form-control" required>
                        @error('color')
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

