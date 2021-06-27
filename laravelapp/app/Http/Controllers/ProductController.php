<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    public function index()
    {
        $results['data'] = Product::all();
        return view('admin.product', $results);
    }

    public function manage_product($id='')
    {
        if($id>0){
            $arr = Product::where(['id'=>$id])->first();
            $result['id'] = $arr->id;
            $result['category_id'] = $arr->category_id;
            $result['name'] = $arr->name;
            $result['image'] = $arr->image;
            $result['slug'] = $arr->slug;
            $result['brand'] = $arr->brand;
            $result['modal'] = $arr->modal;
            $result['short_desc'] = $arr->short_desc;
            $result['desc'] = $arr->desc;
            $result['keywords'] = $arr->keywords;
            $result['technical_specification'] = $arr->technical_specification;
            $result['uses'] = $arr->uses;
            $result['warranty'] = $arr->warranty;
            $result['status'] = $arr->status;
            // Products Attr
            $result['productAttrArr'] = DB::table('product_attr')->where(['product_id'=>$id])->get();
  
        } else {

            $result['id'] = 0;
            $result['category_id'] = '';
            $result['name'] = '';
            $result['image'] = '';
            $result['slug'] = '';
            $result['brand'] = '';
            $result['modal'] = '';
            $result['short_desc'] = '';
            $result['desc'] = '';
            $result['keywords'] = '';
            $result['technical_specification'] = '';
            $result['uses'] = '';
            $result['warranty'] = '';
            $result['status'] = '';
            
            $result['productAttrArr'][0]['id'] = '';
            $result['productAttrArr'][0]['attr_image'] = '';
            $result['productAttrArr'][0]['sku'] = '';
            $result['productAttrArr'][0]['mrp'] = '';
            $result['productAttrArr'][0]['price'] = '';
            $result['productAttrArr'][0]['qty'] = '';
            $result['productAttrArr'][0]['size_id'] = '';
            $result['productAttrArr'][0]['color_id'] = '';
        }

        $result['category'] = DB::table('categories')->where(['status'=>1 ])->get();
        $result['sizes'] = DB::table('sizes')->where(['status'=>1])->get();
        $result['colors'] = DB::table('colors')->where(['status'=>1])->get();

        return view('admin.manage_product', $result);
    }

    public function manage_product_process(Request $request)
    {
        if($request->post('id') > 0 ){
            $image_required = 'mimes:jpeg,jpg,png';
        } else {
            $image_required = 'required|mimes:jpeg,jpg,png';
        }

        $request->validate([
            'name' => 'required',
            'image' => $image_required,
            'slug' => 'required|unique:products,slug,'.$request->post('id'),
            'attr_image.*' => 'mimes:jpg,jpeg,png'
        ]);


        if($request->post('id') > 0 ){
            $model = Product::find($request->post('id'));
            $msg = 'Product update successfully';
        } else {
            $model = new Product();
            $msg = 'Product save successfully';
        }

        if($request->hasfile('image'))
        {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media', $image_name);
            $model->image = $image_name;
        }

        $paidArr = $request->post('paid');
        $skuArr = $request->post('sku');
        $mrpArr = $request->post('mrp');
        $priceArr = $request->post('price');
        $qtyArr = $request->post('qty');
        $sizeArr = $request->post('size');
        $colorArr = $request->post('color');
        foreach($skuArr as $key=>$value) {
            $check = DB::table('product_attr')->
            where('sku', '=', $skuArr[$key])->
            where('id', '!=', $paidArr[$key])->
            get();
            if(isset($check[0])){
                $request->session()->flash('sku_error', $skuArr[$key].' SKU already used.');
                return redirect(request()->headers->get('referer'));
            }
        }

        $model->name = $request->post('name');
        $model->category_id = $request->post('category_id');
        $model->slug = $request->post('slug');
        $model->brand = $request->post('brand');
        $model->modal = $request->post('modal');
        $model->short_desc = $request->post('short_desc');
        $model->desc = $request->post('desc');
        $model->keywords = $request->post('keywords');
        $model->technical_specification = $request->post('technical_specification');
        $model->uses = $request->post('uses');
        $model->warranty = $request->post('warranty');
        $model->status = 1;
        $model->save();
        $pid = $model->id;

        foreach($skuArr as $key=>$value)
        {
            $productAttrArr['product_id'] = 1;
            $productAttrArr['sku'] = $skuArr[$key];
            $productAttrArr['mrp'] = $mrpArr[$key];
            $productAttrArr['price'] = $priceArr[$key];
            $productAttrArr['qty'] = $qtyArr[$key];
            if($sizeArr[$key] == '')
            {
                $productAttrArr['size_id'] = 0;
            } else {
                $productAttrArr['size_id'] = $sizeArr[$key];
            }
            if($sizeArr[$key] == '')
            {
                $productAttrArr['color_id'] = 0;
            } else {
                $productAttrArr['color_id'] = $colorArr[$key];
            }

            if($request->hasfile("attr_image.$key")) {
                $rand = rand('111111111', '999999999');
                $attr_image = $request->file("attr_image.$key");
                $ext = $attr_image->extension();
                $image_name = $rand.'.'.$ext;
                $attr_image->storeAs('public/media', $image_name);
                $productAttrArr['attr_image'] = $image_name;
            } else {
                $productAttrArr['attr_image'] = '';
            }


            if($paidArr[$key] != '')
            {
                DB::table('product_attr')->where(['id'=>$paidArr[$key]])->update($productAttrArr); 
            } else {
                DB::table('product_attr')->insert($productAttrArr); 
            }
        }

        $request->session()->flash('message', $msg);
        return redirect('admin/product');
    }

    public function delete(Request $request, $id='')
    {
        $model = Product::find($id);
        $model->delete();
        $request->session()->flash('message', 'Product Deleted');
        return redirect('admin/product');
    }

    public function status(Request $request, $status, $id)
    {
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status Updated');
        return redirect('admin/product');
    }

    public function product_attr_delete(Request $request, $id, $pid)
    {
        DB::table('product_attr')->where(['id'=>$id])->delete();
        return redirect('admin/product/manage_product/'.$pid);
    }
    
}
