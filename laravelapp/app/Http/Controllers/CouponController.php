<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $results['data'] = Coupon::all();
        return view('admin.coupon', $results);
    }

    public function manage_coupon($id='')
    {
        if($id>0) {
            $arr = Coupon::where(['id'=>$id])->first();
            $result['id'] = $arr->id;
            $result['coupon_name'] = $arr->coupon_name;
            $result['coupon_code'] = $arr->coupon_code;
            $result['coupon_value'] = $arr->coupon_value;
        } else {
            $result['id'] = 0;
            $result['coupon_name'] = '';
            $result['coupon_code'] = '';
            $result['coupon_value'] = '';
        }
        return view('admin.manage_coupon', $result);
    }

    public function manage_coupon_process(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_code' => 'required|unique:coupons,coupon_code,'.$request->post('id'),
            'coupon_value' => 'required',
        ]);

        if($request->post('id') > 0) {
            $model = Coupon::find($request->post('id'));
            $msg = 'Coupon updated successfully';
        } else {
            $model = new Coupon();
            $msg = 'Coupon created successfully';
        }

        $model->coupon_name = $request->post('coupon_name');
        $model->coupon_code = $request->post('coupon_code');
        $model->coupon_value = $request->post('coupon_value');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/coupon');
    }

    public function delete(Request $request, $id)
    {
        $model=Coupon::find($id);
        $model->delete();
        $request->session()->flash('message', 'Coupon deleted successfully.');
        return redirect('admin/coupon');
    }

    public function status(Request $request, $status, $id)
    {
        $model=Coupon::find($id);
        $model->status = $status;
        $model->save();
        if($status == 1) {
            $msg = 'Coupon activate successfully';
        } else {
            $msg = 'Coupon deactivate successfully';
        }
        $request->session()->flash('message', $msg);
        return redirect('admin/coupon'); 
    }
}
