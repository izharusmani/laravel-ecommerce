@extends('admin.layout')
@section('page_title', 'Products')
@section('product_select', 'active')
@section('admin.content')

@if($id>0)
    {{$required=""}}
@else
    {{$required="required"}}
@endif
<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Add Product</h2>
            <a href="{{url('admin/product')}}" class="au-btn au-btn-icon au-btn--blue">
                <i class="zmdi zmdi-arrow-back"></i>Back</a>
        </div>
    </div>
</div>
@if(session()->has('sku_error'))
<div class="alert alert-danger mt-3">{{session('sku_error')}}</div>
@endif
@error('attr_image.*')
<div class="alert alert-danger mt-3">{{$message}}</div>
@enderror
<form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
@csrf
<div class="row m-t-30">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">Add Product</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="control-label mb-1">Name</label>
                    <input id="name" value="{{$name}}" name="name" type="text" class="form-control" required>
                    @error('name')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug" class="control-label mb-1">Slug</label>
                    <input id="slug" value="{{$slug}}" name="slug" type="text" class="form-control" required>
                    @error('slug')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image" class="control-label mb-1">Thumbnail</label>
                    <input id="image" name="image" type="file" class="form-control" {{$required}}>
                    @if($image != '')
                    <div class="preview_thumb"><img width="150px" class="border border-primary p-2 mt-2" src="{{asset('storage/media/'.$image)}}" alt="{{$name}}" /></div>
                    @endif
                    @error('image')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id" class="control-label mb-1">Categories</label>
                            <select id="category_id" name="category_id" type="text" class="form-control">
                                <option value="">Select Categories</option>
                                @foreach($category as $list)
                                    @if($category_id == $list->id)
                                        <option selected value="{{$list->id}}">
                                    @else
                                        <option value="{{$list->id}}">
                                    @endif
                                        {{$list->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="brand" class="control-label mb-1">Brand</label>
                            <input id="brand" value="{{$brand}}" name="brand" type="text" class="form-control">
                            @error('brand')
                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="modal" class="control-label mb-1">Modal</label>
                            <input id="modal" value="{{$modal}}" name="modal" type="text" class="form-control">
                            @error('modal')
                            <div class="alert alert-danger" role="alert">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="short_desc" class="control-label mb-1">Short Description</label>
                    <textarea id="short_desc" name="short_desc" type="text" class="form-control">{{$short_desc}}</textarea>
                    @error('short_desc')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desc" class="control-label mb-1">Description</label>
                    <textarea id="desc" name="desc" type="text" class="form-control">{{$desc}}</textarea>
                    @error('desc')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="keywords" class="control-label mb-1">keywords</label>
                    <textarea id="keywords" name="keywords" type="text" class="form-control">{{$keywords}}</textarea>
                    @error('keywords')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="technical_specification" class="control-label mb-1">Technical Specification</label>
                    <textarea id="technical_specification" name="technical_specification" type="text" class="form-control">{{$technical_specification}}</textarea>
                    @error('technical_specification')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="uses" class="control-label mb-1">Uses</label>
                    <textarea id="uses" name="uses" type="text" class="form-control">{{$uses}}</textarea>
                    @error('uses')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="warranty" class="control-label mb-1">Warranty</label>
                    <textarea id="warranty" name="warranty" type="text" class="form-control">{{$warranty}}</textarea>
                    @error('warranty')
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12"><div class="cardheader mb-3"><h4>Product Attributes</h4></div></div>
    <div class="col-lg-12" id="product_attr_box">
        @php 
            $loop_count_num=1;
        @endphp
        @foreach($productAttrArr as $key => $parr)
        @php 
            $attr = (array)$parr; 
            $loop_count_prev = $loop_count_num;    
        @endphp
        <div class="card" id="product_attr_{{$loop_count_num++}}">
            <input type="hidden" name="paid[]" value="{{$attr['id']}}" id="paid">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sku" class="control-label mb-1">SKU</label>
                            <input id="sku" value="{{$attr['sku']}}" name="sku[]" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mrp" class="control-label mb-1">MRP</label>
                            <input id="mrp" value="{{$attr['mrp']}}" name="mrp[]" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="price" class="control-label mb-1">Price</label>
                            <input id="price" value="{{$attr['price']}}" name="price[]" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="qty" class="control-label mb-1">Quantity</label>
                            <input id="qty" value="{{$attr['qty']}}" name="qty[]" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="size" class="control-label mb-1">Size</label>
                            <select name="size[]" id="size" class="form-control">
                                <option value="">Select Size</option>
                                @foreach($sizes as $list)
                                    @if($list->id == $attr['size_id'])
                                    <option selected value="{{$list->id}}">{{$list->size}}</option>
                                    @else
                                    <option value="{{$list->id}}">{{$list->size}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="color" class="control-label mb-1">Color</label>
                            <select name="color[]" id="color" class="form-control">
                                <option value="">Select Color</option>
                                @foreach($colors as $list)
                                    @if($list->id == $attr['color_id'])
                                    <option selected value="{{$list->id}}">{{$list->color}}</option>
                                    @else
                                    <option value="{{$list->id}}">{{$list->color}}</option>
                                    @endif
                                @endforeach
                            </select>    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="attr_image" class="control-label mb-1">Image</label>
                            <input id="attr_image" name="attr_image[]" type="file" class="form-control" required>
                            @if($attr['attr_image'] != '')
                            <img src="{{asset('storage/media/'.$attr['attr_image'])}}" width="150px" class="border border-primary p-2 mt-2" alt="attr_image">
                            @endif
                        </div>
                    </div>
                    @if($loop_count_num == 2)
                    <div class="col-md-2 mt-4 pt-2">
                        <div class="form-group">
                            <button id="add" name="add" type="button" class="form-control btn btn-success" onclick="add_more()"><i class="fa fa-plus"></i> &nbsp; Add</button>
                        </div>
                    </div>
                    @else
                    <div class="col-md-2 mt-4 pt-2">
                        <div class="form-group">
                            <a href="{{url('admin/product/product_attr_delete/'.$attr['id'].'/'.$id)}}"><button id="remove" name="remove" type="button" class="form-control btn btn-danger"><i class="fa fa-minus"></i> &nbsp; Remove</button></a>
                        </div>
                    </div> 
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="submit_form_btn">
    <button id="category-button" type="submit" class="btn btn-lg btn-info btn-block">Save</button>
</div> 
<input type="hidden" name="id" value="{{$id}}">
</form>

<script>

var loop_count = 1;
function add_more()
{
    loop_count++;
    var html = '<input type="hidden" name="paid[]" id="paid"><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="row">';

    html += '<div class="col-md-4"><div class="form-group"><label for="sku" class="control-label mb-1">SKU</label><input id="sku" name="sku[]" type="text" class="form-control" required></div></div>';

    html += '<div class="col-md-4"><div class="form-group"><label for="mrp" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" required></div></div>';

    html += '<div class="col-md-4"><div class="form-group"><label for="price" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" required></div></div>';

    html += '<div class="col-md-4"><div class="form-group"><label for="qty" class="control-label mb-1">Quantity</label><input id="qty" name="qty[]" type="text" class="form-control" required></div></div>';

    var size_id_html = jQuery('#size').html();
    size_id_html = size_id_html.replace('selected', '');
    html += '<div class="col-md-4"><div class="form-group"><label for="size" class="control-label mb-1">Size</label><select name="size[]" id="size" class="form-control">'+size_id_html+'</select></div></div>';

    var color_id_html = jQuery('#color').html();
    color_id_html = color_id_html.replace('selected', '');
    html += '<div class="col-md-4"><div class="form-group"><label for="color" class="control-label mb-1">Color</label><select name="color[]" id="color" class="form-control">'+color_id_html+'</select></div></div>';

    html += '<div class="col-md-4"><div class="form-group"><label for="attr_image" class="control-label mb-1">Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" required></div></div>';

    html += '<div class="col-md-2 mt-4 pt-2"><div class="form-group"><button id="remove" name="remove" type="button" class="form-control btn btn-danger" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i> &nbsp; Remove</button></div></div>';
    
    html += '</div></div></div>';
    
    jQuery('#product_attr_box').append(html);
}

function remove_more(loop_count)
{
    jQuery('#product_attr_'+loop_count).remove();
}
</script>

@endsection