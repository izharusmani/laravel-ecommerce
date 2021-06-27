@extends('admin.layout')
@section('page_title', 'Color Attribute')
@section('color_select', 'active')
@section('admin.content')

<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Color</h2>
            <a href="{{url('admin/color/manage_color')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="zmdi zmdi-plus"></i>Add Color</a>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        @if(session()->has('message'))
        <div class="alert alert-success" role="alert">{{session('message')}}</div>
        @endif
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-data3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->color}}</td>
                        <td>
                            
                            <a href="{{url('admin/color/manage_color/')}}/{{$list->id}}"><i class="fas fa-lg fas fa-pencil-square-o"></i></a> | 
                            @if($list->status == 1) 
                            <a href="{{url('admin/color/status/0')}}/{{$list->id}}"><i class="fas fa-lg fas fa-check"></i></a> | 
                            @elseif($list->status == 0)
                            <a href="{{url('admin/color/status/1')}}/{{$list->id}}"><i class="fas fa-lg fas fa-times"></i></a> | 
                            @endif
                            <a href="{{url('admin/color/delete/')}}/{{$list->id}}"><i class="fas fa-lg fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE-->
    </div>
</div>

@endsection