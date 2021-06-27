@extends('admin.layout')
@section('page_title', 'Manage Coupon')
@section('coupon_select', 'active')
@section('admin.content')

<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Add Coupon</h2>
            <a href="{{url('admin/coupon')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="zmdi zmdi-arrow-back"></i>Back</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Add Coupon</div>
            <div class="card-body">
                <form action="{{route('coupon.manage_coupon_process')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="coupon_name" class="control-label mb-1">Title</label>
                        <input id="coupon_name" value="{{$coupon_name}}" name="coupon_name" type="text" class="form-control" required>
                        @error('coupon_name')
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="coupon_code" class="control-label mb-1">Code</label>
                        <input id="coupon_code" value="{{$coupon_code}}" name="coupon_code" type="text" class="form-control" required>
                        @error('coupon_code')
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="coupon_value" class="control-label mb-1">Value</label>
                        <input id="coupon_value" name="coupon_value" value="{{$coupon_value}}" class="form-control">
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