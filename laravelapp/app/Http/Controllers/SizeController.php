<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['data'] = Size::all();
        return view('admin.size', $result);
    }

    public function manage_size($id='')
    {
        if($id>0) {
            $arr = Size::where(['id'=>$id])->first();
            $result['size'] = $arr->size;
            $result['id'] = $arr->id;
        } else {
            $result['size'] = '';
            $result['id'] = '';
        }
        return view('admin.manage_size', $result);
    }

    public function manage_size_process(Request $request)
    {
        $request->validate([
            'size' => 'required'
        ]);
        
        if($request->post('id')>0) {
            $model = Size::find($request->post('id'));
            $msg = 'Record update successfully';
        } else {
            $model = new Size();
            $msg = 'Record save successfully';
        }

        $model->size = $request->post('size');
        $model->status = 1;
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/size');
    }

    public function delete(Request $request, $id) 
    {
        $model = Size::find($id);
        $model->delete();
        $request->session()->flash('message', 'Record deleteed successfully');
        return redirect('admin/size');
    }

    public function status(Request $request, $status, $id) 
    {
        $model = Size::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('message', 'Status update successfully');
        return redirect('admin/size');
    }

    
}
